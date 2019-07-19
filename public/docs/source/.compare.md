---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#general
<!-- START_b63c55c4bd1dca269829c5efb74328c8 -->
## product
> Example request:

```bash
curl -X GET -G "http://localhost/product" 
```

```javascript
const url = new URL("http://localhost/product");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (500):

```json
{
    "message": "The Mix manifest does not exist. (View: \/var\/www\/html\/website\/resources\/views\/layout\/master.blade.php) (View: \/var\/www\/html\/website\/resources\/views\/layout\/master.blade.php)",
    "exception": "ErrorException",
    "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/helpers.php",
    "line": 573,
    "trace": [
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/View\/Engines\/PhpEngine.php",
            "line": 45,
            "function": "handleViewException",
            "class": "Illuminate\\View\\Engines\\CompilerEngine",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/View\/Engines\/CompilerEngine.php",
            "line": 59,
            "function": "evaluatePath",
            "class": "Illuminate\\View\\Engines\\PhpEngine",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/View\/View.php",
            "line": 137,
            "function": "get",
            "class": "Illuminate\\View\\Engines\\CompilerEngine",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/View\/View.php",
            "line": 120,
            "function": "getContents",
            "class": "Illuminate\\View\\View",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/View\/View.php",
            "line": 85,
            "function": "renderContents",
            "class": "Illuminate\\View\\View",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Http\/Response.php",
            "line": 42,
            "function": "render",
            "class": "Illuminate\\View\\View",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/symfony\/http-foundation\/Response.php",
            "line": 206,
            "function": "setContent",
            "class": "Illuminate\\Http\\Response",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 724,
            "function": "__construct",
            "class": "Symfony\\Component\\HttpFoundation\\Response",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 698,
            "function": "toResponse",
            "class": "Illuminate\\Routing\\Router",
            "type": "::"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 658,
            "function": "prepareResponse",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/SubstituteBindings.php",
            "line": 41,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\SubstituteBindings",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/VerifyCsrfToken.php",
            "line": 68,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/View\/Middleware\/ShareErrorsFromSession.php",
            "line": 49,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\View\\Middleware\\ShareErrorsFromSession",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Session\/Middleware\/StartSession.php",
            "line": 63,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Session\\Middleware\\StartSession",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Cookie\/Middleware\/AddQueuedCookiesToResponse.php",
            "line": 37,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Cookie\/Middleware\/EncryptCookies.php",
            "line": 66,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Cookie\\Middleware\\EncryptCookies",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 660,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 635,
            "function": "runRouteWithinStack",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 601,
            "function": "runRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 590,
            "function": "dispatchToRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 176,
            "function": "dispatch",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 30,
            "function": "Illuminate\\Foundation\\Http\\{closure}",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/fideloper\/proxy\/src\/TrustProxies.php",
            "line": 56,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Fideloper\\Proxy\\TrustProxies",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/ValidatePostSize.php",
            "line": 27,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/CheckForMaintenanceMode.php",
            "line": 46,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\CheckForMaintenanceMode",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 151,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 116,
            "function": "sendRequestThroughRouter",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Tools\/ResponseStrategies\/ResponseCallStrategy.php",
            "line": 272,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Tools\/ResponseStrategies\/ResponseCallStrategy.php",
            "line": 256,
            "function": "callLaravelRoute",
            "class": "Mpociot\\ApiDoc\\Tools\\ResponseStrategies\\ResponseCallStrategy",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Tools\/ResponseStrategies\/ResponseCallStrategy.php",
            "line": 33,
            "function": "makeApiCall",
            "class": "Mpociot\\ApiDoc\\Tools\\ResponseStrategies\\ResponseCallStrategy",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Tools\/ResponseResolver.php",
            "line": 49,
            "function": "__invoke",
            "class": "Mpociot\\ApiDoc\\Tools\\ResponseStrategies\\ResponseCallStrategy",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Tools\/ResponseResolver.php",
            "line": 68,
            "function": "resolve",
            "class": "Mpociot\\ApiDoc\\Tools\\ResponseResolver",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Tools\/Generator.php",
            "line": 54,
            "function": "getResponse",
            "class": "Mpociot\\ApiDoc\\Tools\\ResponseResolver",
            "type": "::"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Commands\/GenerateDocumentation.php",
            "line": 194,
            "function": "processRoute",
            "class": "Mpociot\\ApiDoc\\Tools\\Generator",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Commands\/GenerateDocumentation.php",
            "line": 56,
            "function": "processRoutes",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "function": "handle",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 29,
            "function": "call_user_func_array"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 87,
            "function": "Illuminate\\Container\\{closure}",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 31,
            "function": "callBoundMethod",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/Container.php",
            "line": 549,
            "function": "call",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 183,
            "function": "call",
            "class": "Illuminate\\Container\\Container",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/symfony\/console\/Command\/Command.php",
            "line": 255,
            "function": "execute",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 170,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Command\\Command",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/symfony\/console\/Application.php",
            "line": 953,
            "function": "run",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/symfony\/console\/Application.php",
            "line": 248,
            "function": "doRunCommand",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/symfony\/console\/Application.php",
            "line": 148,
            "function": "doRun",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Application.php",
            "line": 88,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Console\/Kernel.php",
            "line": 121,
            "function": "run",
            "class": "Illuminate\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/website\/artisan",
            "line": 37,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Console\\Kernel",
            "type": "->"
        }
    ]
}
```

### HTTP Request
`GET product`


<!-- END_b63c55c4bd1dca269829c5efb74328c8 -->


