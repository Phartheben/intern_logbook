<?php

namespace App\Console\Commands\Propel;

use Illuminate\Console\Command;

class PropelBuildConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'propel:build-config {--all=false}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Propel build config.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->buildConfig();
    }

    private function buildConfig()
    {
        $this->info("propel > build-config : reading configuration\n");

        $dbDefault = \Config::get('database.connections.'.\Config::get('database.default'));
        $ini = new \App\Vetter\Vendor\Jelix\IniFile\IniModifier(config_path('/propel/config/build.properties'));

        $ini->setValue('propel.database', array_get($dbDefault, 'driver'));
        $ini->setValue('propel.database.user', array_get($dbDefault, 'username'));
        $ini->setValue('propel.database.password', array_get($dbDefault, 'password'));
        $ini->setValue('propel.database.url', $this->generateDsn($dbDefault));
        $ini->save();

        $runtimeFile   = config_path('/propel/config/runtime-conf.xml');
        $xml = new \SimpleXMLElement ($runtimeFile, null, true);

        // default node
        $node = $xml->xpath("//config/propel/datasources/datasource[@id='orm']");
        $default_node = array_get($node, 0);
        if ($default_node) {
            $default_node->adapter              = array_get($dbDefault, 'driver');
            $default_node->connection->dsn      = $this->generateDsn($dbDefault);
            $default_node->connection->user     = array_get($dbDefault, 'username');
            $default_node->connection->password = array_get($dbDefault, 'password');
        }

        // write back to xml file
        $dom = new \DOMDocument ('1.0', 'UTF-8');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML ($xml->asXML());
        $dom->save ($runtimeFile);

        $buildtimeFile = config_path('/propel/config/buildtime-conf.xml');
        $dom->save ($buildtimeFile);

        $this->info("propel > build-config : configuration updated\n");
    }

    private function generateDsn($config) {

        $dsn = '';

        $driver   = array_get($config, 'driver');
        $host     = array_get($config, 'host');
        $port     = array_get($config, 'port');
        $database = array_get($config, 'database');
        $charset  = array_get($config, 'charset');

        switch($driver)
        {
            # PDO connection strings:
            #   mysql:host=localhost;port=3306;dbname=mydb
            #   sqlite:/opt/databases/mydb.sq3
            #   sqlite::memory:
            #   pgsql:host=localhost;port=5432;dbname=testdb;user=bruce;password=mypass
            #   oci:dbname=//localhost:1521/mydb
            case 'mysql':
                $arr   = array();
                $arr[] = $host ? 'host='.$host : '';
                $arr[] = $port ? 'port='.$port : '';
                $arr[] = $database ? 'dbname='.$database : '';
                $arr[] = $charset ? 'charset='.$charset : '';

                $arr = array_filter($arr);
                $dsn = sprintf('mysql:%s', implode(';', $arr));

                break;
        }

        return $dsn;
    }

}
