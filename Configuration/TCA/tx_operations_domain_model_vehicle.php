<?php

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

if (!defined ('TYPO3')) {
	die ('Access denied.');
}

$extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('operations');

return [
	'ctrl' => [
        'title' => 'LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tx_operations_domain_model_vehicle',
        //'label' => 'title',
        'label' => 'short',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'sortby' => 'sorting',
        'versioningWS' => true,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
                'disabled' => 'hidden',
                'starttime' => 'starttime',
                'endtime' => 'endtime',
        ],
        'searchFields' => 'title,short,description,media,',
        'typeicon_classes' => ['default' => 'ext-operations-vehicle']
    ],
	'types' => [
		'0' => [
            'showitem' => 'sys_language_uid;LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language,l10n_parent;LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent,l10n_diffsource,hidden;LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden,title,path_segment,short,description,link,--div--;LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tca.divTitle.media,--palette--;LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tca.paletteTitleVehicles.media;paletteImg'
        ],
    ],
	'palettes' => [
		'paletteImg' => [
			'showitem' => 'media',
			'canNotCollapse' => 'TRUE'
        ],
    ],
	'columns' => [
		'sys_language_uid' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => [
                    [
                        'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.default_value',
                        0
                    ],
                    [
                        'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ],
                ],
                'default' => 0
            ],
        ],
		'l10n_parent' => [
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
			'config' => [
				'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
					['', 0],
                ],
				'foreign_table' => 'tx_operations_domain_model_vehicle',
				'foreign_table_where' => 'AND tx_operations_domain_model_vehicle.pid=###CURRENT_PID### AND tx_operations_domain_model_vehicle.sys_language_uid IN (-1,0)',
                'default' => 0
            ],
        ],
		'l10n_diffsource' => [
			'config' => [
				'type' => 'passthrough',
            ],
        ],
		't3ver_label' => [
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.versionLabel',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'max' => 255,
            ]
        ],
		'hidden' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
			'config' => [
				'type' => 'check',
            ],
        ],
		'starttime' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
			'config' => [
				'type' => 'input',
				'size' => 13,
				'eval' => 'datetime',
                'renderType' => 'inputDateTime',
				'checkbox' => 0,
				'default' => 0,
				'range' => [
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
                'behaviour' => ['allowLanguageSynchronization' => true],
            ],
        ],
		'endtime' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
			'config' => [
				'type' => 'input',
				'size' => 13,
				'eval' => 'datetime',
                'renderType' => 'inputDateTime',
				'checkbox' => 0,
				'default' => 0,
				'range' => [
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
                'behaviour' => ['allowLanguageSynchronization' => true],
            ],
        ],
		'title' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tx_operations_domain_model_vehicle.title',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
            ],
        ],
        'path_segment' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tx_operations_domain_model_operation.path_segment',
            'config' => [
                'type' => 'slug',
                'generatorOptions' => [
                    'fields' => ['title'],
                    'fieldSeparator' => '/',
                    'prefixParentPageSlug' => true
                ],
                'fallbackCharacter' => '-',
                'eval' => $extensionConfiguration['slugBehaviour'],
            ]
        ],
		'short' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tx_operations_domain_model_vehicle.short',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
            ],
        ],
		'description' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tx_operations_domain_model_vehicle.description',
			'config' => [
				'type' => 'text',
                'enableRichtext' => true,
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
            ],
        ],
		'media' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tx_operations_domain_model_vehicle.media',
            'config' => ExtensionManagementUtility::getFileFieldTCAConfig('media', [
                'appearance' => [
                    'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/Database.xlf:tt_content.asset_references.addFileReference'
                ],
                // custom configuration for displaying fields in the overlay/reference table
                'overrideChildTca' => [
                    'types' => [
                        '0' => [
                            'showitem' => '
                                --palette--;;imageoverlayPalette,
                                --palette--;;filePalette'
                        ],
                        File::FILETYPE_TEXT => [
                            'showitem' => '
                                --palette--;;imageoverlayPalette,
                                --palette--;;filePalette'
                        ],
                        File::FILETYPE_IMAGE => [
                            'showitem' => '
                                --palette--;;imageoverlayPalette,
                                --palette--;;filePalette'
                        ],
                        File::FILETYPE_AUDIO => [
                            'showitem' => '
                                --palette--;;audioOverlayPalette,
                                --palette--;;filePalette'
                        ],
                        File::FILETYPE_VIDEO => [
                            'showitem' => '
                                --palette--;;videoOverlayPalette,
                                --palette--;;filePalette'
                        ],
                    ],
                ],
            ], $GLOBALS['TYPO3_CONF_VARS']['SYS']['mediafile_ext'])
        ],
        'link' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tx_operations_domain_model_vehicle.link',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputLink',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
    ],
];
