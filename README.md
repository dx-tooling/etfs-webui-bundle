# Janus WebUI Bundle

## How to install and setup this bundle in a Janus Application

### 1. Composer Setup

First, configure the repository in your application's `composer.json`:

```json
{
    "repositories": [
        {
            "name": "enterprise-tooling-for-symfony/webui-bundle:path",
            "type": "path",
            "url": "../webui-bundle",
            "options": {
                "symlink": true
            }
        }
    ]
}
```

Then require the bundle:

```bash
composer require enterprise-tooling-for-symfony/webui-bundle:dev-master
```


### 2. Bundle Registration

The bundle should be automatically registered via Symfony Flex. If not, add it manually to your `config/bundles.php`:

```php
<?php

return [
    // ... other bundles
    EnterpriseToolingForSymfony\WebuiBundle\WebuiBundle::class => ['all' => true],
];
```


### 3. Router Configuration

Add the bundle's routes to your `config/routes.yaml`:

```yaml
webui:
    resource: '@WebuiBundle/config/routes.yaml'
```


### 4. CSS Setup

Import the bundle's CSS in your main application CSS file (`assets/styles/app.css`):

```css
@import url("../../vendor/enterprise-tooling-for-symfony/webui-bundle/assets/styles/webui.css");
```

Replace your local TailwindCSS configuration with the one from the bundle, in file `tailwind.config.js`:

```javascript
import WebuiTailwindConfig from './vendor/enterprise-tooling-for-symfony/webui-bundle/tailwind.config.js';

/** @type {import('tailwindcss').Config} */
module.exports = WebuiTailwindConfig;
```


### 5. JavaScript/Stimulus Setup

#### 5.1 Import Map Configuration

The bundle's JavaScript is automatically configured via the importmap. Verify that your `importmap.php` includes:

```php
<?php

return [
    // ...
    '@enterprise-tooling-for-symfony/webui' => [
        'path' => './vendor/enterprise-tooling-for-symfony/webui-bundle/assets/index.js',
    ],
];
```


#### 5.2 Stimulus Bootstrap

In your application's `assets/bootstrap.ts`, bootstrap the Janus WebUI client-side code with your Stimulus App:

```typescript
import { webuiBootstrap } from "@enterprise-tooling-for-symfony/webui";

const app = startStimulusApp();

webuiBootstrap(app);
```



### 6. Main Navigation Setup

Create a service that extends `AbstractMainNavigationService`. For example:

```php
<?php

namespace App\Common\Presentation\Service;

use EnterpriseToolingForSymfony\WebuiBundle\Entity\MainNavigationEntry;
use EnterpriseToolingForSymfony\WebuiBundle\Service\AbstractMainNavigationService;

class MainNavigationPresentationService extends AbstractMainNavigationService
{
    public function getPrimaryMainNavigationEntries(): array
    {
        return [
            // Your navigation entries in the form of MainNavigationEntry objects
        ];
    }

    protected function getSecondaryMainNavigationEntries(): array
    {
        return [
            // Your navigation entries in the form of MainNavigationEntry objects
        ];
    }
    
    public function getTertiaryMainNavigationEntries(): array
    {
        return [
            // Your navigation entries in the form of MainNavigationEntry objects
        ];
    }
}
```

The bundle will automatically detect your navigation service implementation and use it for rendering the navigation components.


### 7. Template Setup

To use the navigation components, extend the bundle's base template in your application's base template:

```twig
{% extends '@Webui/base_appshell.html.twig' %}
```

Or include the navigation components manually:

```twig
<div {{ stimulus_controller('webuiMainNavigation') }} class="min-h-screen">
    {{ component('webui|main_navigation|small_viewport|appshell') }}
    {{ component('webui|main_navigation|large_viewport|appshell') }}
</div>
```


## Living Styleguide

When working in development mode, your app provides a living styleguide at `/living-styleguide` to preview available components and styles.
