angular.module('service', []).service('localstorageservice', [
    function() {
        /**
         * This module contains all library function for localstorage usage
         */
        this.methods = {

            /**
             * Checks if localstorage is supported on the current browser
             */
            hasStorage: function() {
                try {
                    localStorage.setItem('test', '7');
                    if (localStorage.getItem('test') === '7') {
                        localStorage.removeItem('test');
                        return true;
                    }
                } catch (er) {}
                return false;
            },

            /**
             * Set's a key to localstorage. Overrides if already present
             * E.g. set("userid", "pharz")
             * E.g. set({userid: "pharz", lname: "selvam"})
             */
            set: function(key, value) {
                try {
                    if (typeof key === "object") {
                        // There are multiple keys
                        var keys = key;

                        for (key in keys) {
                            if (keys.hasOwnProperty(key)) {
                                var value = key[key];
                                if (typeof value === "object") {
                                    value = JSON.stringify(value);
                                }
                                localStorage.setItem(key, value);
                            }
                        }

                    } else {
                        if (typeof value === "object") {
                            value = JSON.stringify(value);
                        }
                        localStorage.setItem(key, value);
                    }
                    return true;
                } catch (er) {
                    return false;
                }
            },

            /**
             * Get's the value for a localstorage key. If no parameter is provided it returns all the values.
             * E.g: get("userid") or get(["userid", "fname"])
             */
            get: function(keys) {
                try {
                    if (keys) {
                        if (typeof keys === "object") {
                            var valObj = {};
                            for (var index in keys) {
                                if (keys.hasOwnProperty(index)) {
                                    var key = keys[index];
                                    if (typeof key === "string") {
                                        var val = this.get(key);
                                        valObj[key] = val;
                                    }
                                }
                            }
                            return valObj;
                        } else {
                            return localStorage.getItem(keys);
                        }
                    } else {
                        return this.all();
                    }
                } catch (er) {
                    return false;
                }
            },

            /**
             * Removes a key from localstorage
             * @param  {[string/array]} keys
             * E.g: remove("userid") or remove(["userid", "lname"])
             * Returns the values removed
             */
            remove: function(keys) {
                try {
                    var val;
                    if (typeof keys === "object") {
                        var removedVals = [];
                        for (var index in keys) {
                            if (keys.hasOwnProperty(index)) {
                                var key = keys[index];
                                if (typeof key === "string") {
                                    val = this.get(key);
                                    localStorage.removeItem(key);
                                    removedVals.push(val);
                                }
                            }
                        }
                        return removedVals;
                    } else {
                        val = this.get(keys);
                        localStorage.removeItem(keys);
                        return val;
                    }
                } catch (er) {
                    return false;
                }
            },

            /**
             * @return Returns a JSON object with all key value pair
             */
            all: function() {
                try {
                    var i = 0,
                        oJson = {},
                        sKey;
                    for (; i < localStorage.length; i++) {
                        sKey = localStorage.key(i);
                        oJson[sKey] = localStorage.getItem(sKey);
                    }
                    return oJson;
                } catch (er) {
                    return false;
                }
            },

            /**
             * Clears all the localstorage values
             */
            clear: function() {
                try {
                    localStorage.clear();
                    return true;
                } catch (er) {
                    return false;
                }
            },

            /**
             * @return {Boolean} Whether or not a key is present in localstorage
             */
            isKey: function(key) {
                try {
                    if (localStorage.getItem(key)) {
                        return true;
                    }
                    return false;
                } catch (er) {
                    return false;
                }
            }
        };
    }
]);
