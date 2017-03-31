<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AvatarUploadTest extends TestCase
{

	use WithoutMiddleware;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
    	$stub = __DIR__.'/stubs/IMG_0085.jpg';
        $name = str_random(8).'.jpg';
        $path = sys_get_temp_dir().'/'.$name;
        copy($stub, $path);

        $file = new \Illuminate\Http\UploadedFile($path, $name, filesize($path), 'image/png', null, true);

    	$response = $this->json('POST', '/api/profile/avatar/16', [
					    			'avatar' => $file
					    		])->dump();

    }
}
