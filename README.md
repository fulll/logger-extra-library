Xeonys Logger Extra
===================

- Add extra data to logs
- ELK stack default configuration

## Installation

composer.json

```json
    "require": {
        "graylog2/gelf-php": "~1.4",
        "inextensodigital/logger-extra-library": "~1.0"
    }
```


AppKernel

```php
$bundles[] = new Xeonys\LoggerExtra\App\Bundle\XeonysLoggerExtraBundle();
```

config.yml

```yml
xeonys_logger_extra:
    fields:
        app_name:     app_name #your application name.
        app_env:      %xeonys.logger_extra.app_env%
        server_stack: %xeonys.logger_extra.server_stack%
```

config_prod.yml

```yml
imports:
    - { resource: config.yml }
    - { resource: "@XeonysLoggerExtraBundle/Resources/config/monolog_gelf.yml" }
```

parameters.yml

```
    xeonys.elk.gelf.host: elkdomain.tld
    xeonys.elk.gelf.port: 12201 # in local environment, use a different port, to not polluate elk.
    xeonys.logger_extra.app_env: prod
    xeonys.logger_extra.server_stack: local
```

**Do you deal with long process or subprocess which needs finger crossed passthruLevel reinitialized ?**

```
protected function execute(InputInterface $input, OutputInterface $output)
{
    $logger          = $this->getContainer()->get('logger');
    $subprocessScope = $this->getContainer()->get('xeonys.logger_extra.sub_process_scope');

    for ($i = 1; $i <= 10; $i++) {
        $subprocessScope->enter();

        $logger->debug("Begin process($i)");

        try {
            // do something
            $logger->debug("It is ok !!! ($i)");
        } catch (\Exception $e) {
            $logger->critical("Error on ($i)");
        }

        $logger->debug("End process($i)");
    }
}
```

Imagine we have an error on 3rd $i iteration:

**Before**:

You'll have EACH lines logged, because 3rd thrown an error.

**Now**:

You'll have:

```
[debug] Begin process (3)
[critical] Error in ($3)
[debug] end process (3)
```
