<?php return array(
    'root' => array(
        'pretty_version' => '1.0.0+no-version-set',
        'version' => '1.0.0.0',
        'type' => 'library',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'reference' => NULL,
        'name' => '__root__',
        'dev' => true,
    ),
    'versions' => array(
        '__root__' => array(
            'pretty_version' => '1.0.0+no-version-set',
            'version' => '1.0.0.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'reference' => NULL,
            'dev_requirement' => false,
        ),
        'phpstan/phpstan' => array(
            'pretty_version' => '1.10.3',
            'version' => '1.10.3.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../phpstan/phpstan',
            'aliases' => array(),
            'reference' => '5419375b5891add97dc74be71e6c1c34baaddf64',
            'dev_requirement' => true,
        ),
        'rector/rector' => array(
            'pretty_version' => '0.15.19',
            'version' => '0.15.19.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../rector/rector',
            'aliases' => array(),
            'reference' => '4b3a85382e890963a6d00e0ace8d09465f96e370',
            'dev_requirement' => true,
        ),
    ),
);
