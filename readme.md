<h1>Html Tag Builder</h1>

<h2>Install</h2>

Add this into config/app.php

```php
'providers' => array(
    ...
    ...
    'Witooh\TagBuilder\TagBuilderServiceProvider',
```

and

```php
'aliases' => array(
    ...
    ...
    'Tag' => 'Witooh\TagBuilder\Facades\Tag',
```
