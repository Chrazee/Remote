# What's this?
**Remote** is a web based application written in [Laravel](https://www.laravel.com). Made it for managing and categorizing your **custom smart devices** via one and user-friendly web interface.

# How it works
The procedure is very simple. Remote uses the [Guzzle HTTP client](http://docs.guzzlephp.org/en/stable/) to send a **HTTP POST** request to your smart device.  
Each request goes through the **module system**.

## Module system
Remote has a module system which means that you can make **custom templates** for your devices.  
With module templates you can easily manage your devices layout and functionality.

### Module template
The module template is an HTML file, which **contains HTML codes** for your device layout and a little **jQuery script** to create requests for your device.

### Handling device response
Remote provides a **built-in jQuery plugin** fto handle the devices response.
Just put it in your module template between `<script></script>` tags.  
The plugin: 
```javascript
$().makeRequest({
    action: 'get',
    autoUpdateTime: null, 
    parameters: {
    
    },
    responseHandler: function(response) {
    
    },
});
```
| Parameter | Type | Default value | Description |
| ------------- | ------------- | ------------- | ------------- |
| action  | string | get  | Set the device path |
| autoUpdateTime  | int | null | The request re-send every x ms |
| parameters | array | {} | Add parameters to your request |
| responseHandler | function | function() | Access response values from your device within the response variable. The values are in response.data |

### An example
This is a temperature sensors module file. As you can see the jQuery script sends the request every 3200 ms to the device and displays the data in HTML elements.
```html
<div class="row h-100">
    <div class="col-8 align-self-center">
        <h3 class="d-inline-block align-middle">Data</h3>
    </div>
    <div class="col-4 align-self-center">
        <div class="float-right">
            <button type="button" class="btn btn-primary refresh"><i class="fa fa-sync"></i></button>
        </div>
    </div>
</div>
<hr>
<div>
    <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Temperature<span class="badge badge-primary badge-pill">
                <span class="data temperature_c"></span> C&deg; (<span class="data temperature_f"></span> F&deg;)
            </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Humidity <span class="badge badge-primary badge-pill">
                <span class="data humidity"></span> %
            </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Heat index <span class="badge badge-primary badge-pill">
                <span class="data heat_index_c"></span> C&deg; (<span class="data heat_index_f"></span> F&deg;)
            </span>
        </li>
    </ul>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $().makeRequest({
            autoUpdateTime: 3200,
            responseHandler: function(response) {
                $.each(response.data, function(index, value) {
                    $('.data.' + index).html(value);
                });
            },
        });
    });
</script>
```

## Group system
For categorizing your devices, Remote has a group system. You can create infinite group and sub group.

## Security
When you send a request you must validate it in the device code.    
Every user has a **device token**, which is auto-generated when the user is created. This token can be used to authenticate our own devices.  
Remote automatically adds this token to your request as a parameter, called **token**

## Device response conditions
If you plan to make your own device don't forget, Remote has some conditions in your device's response for processing purposes.

+ Remote only accepts JSON content
+ Required keys in the content
  + ``failed_validation``
    + If the validation failed use this key and set the value to ``token``
  + ``status``
    + If the request success set it to ``true`` (for example, the data successfully read from a hardware)
    + If the request failed set it to ``false`` (for example, hardware error)

+ Required HTTP status codes
  + When the ``failed_validation:token`` takes effect use the **422** code
  + When the ``status`` takes effect use the **200** code (because the request was successful, but we had an error with the device)
  
+ Handle 404 error in device (optional)
  + use the `response:404` key-pair in your content
  + set the status code to  **404**
  
### Example code
An example snippet for ESP8266 microcontroller, written in Arduino C++.

```
class Request {
    public:
    static void get() {
        if(!validateToken()) return;
        
        StaticJsonDocument<400> doc;
        
        float h   = round(dht.readHumidity()*100)/100;
        float t   = round(dht.readTemperature()*100)/100;
        float f   = round(dht.readTemperature(true)*100)/100;
        float hif = round(dht.computeHeatIndex(f, h)*100)/100;
        float hic = round(dht.computeHeatIndex(t, h, false)*100)/100;
        
        if (isnan(h) || isnan(t) || isnan(f) || isnan(hif) || isnan(hic)) {
            doc["status"] = false;
        } else {
            doc["status"] = true;
            doc["humidity"] = h;
            doc["temperature_c"] = t;
            doc["temperature_f"] = f;
            doc["heat_index_c"] = hic;
            doc["heat_index_f"] = hif;
        }
        
        char json_string[256];
        serializeJson(doc, json_string);
        
        reply(json_string, 200);
        
        delay(2000);
    }
    
    static void handleNotFound() {
        reply("{\"response\":\"404\"}", 404);
    }
    
    private:
    static void reply(String message, int code) {
        server.send(code, "application/json", message); 
    }
    
    static boolean validateToken() {
        if(server.arg("token") != token) {
            reply("{\"failed_validation\":\"token\"}", 422);
            return false;
        }
        return true;
    }
};
```

# Don't forget
This is an insecure version of the application, and not tested yet.  

# Try it
- To get started make sure you have [Docker](https://docs.docker.com/) and [Docker Compose](https://docs.docker.com/compose/) installed on your system.
- The Docker workflow for the application available in [this repository](https://github.com/Chrazee/Remote-Docker).

# In the future
- Full multi-user support
- Administration roles and admin panel
- Multi protocol support for devices
- Module categories
- Change module files to a custom solution for easier usage and security reasons
- Vue.js support





