<?php
use In2code\Powermail\Domain\Model\Answer;
use In2code\Powermail\Domain\Model\Field;
use In2code\Powermail\Domain\Model\Mail;
use In2code\Powermail\Utility\ConfigurationUtility;

$answersTca = [
    'ctrl' => [
        'title' => 'LLL:EXT:powermail/Resources/Private/Language/locallang_db.xlf:' . Answer::TABLE_NAME,
        'label' => 'value',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'default_sortby' => 'ORDER BY crdate DESC',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'iconfile' => ConfigurationUtility::getIconPath(Answer::TABLE_NAME . '.gif')
    ],
    'types' => [
        '1' => ['showitem' => 'value, value_type, field, mail'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ],
                ],
                'default' => 0,
            ]
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
                'foreign_table' => Answer::TABLE_NAME,
                'foreign_table_where' => 'AND ' . Answer::TABLE_NAME . '.pid=###CURRENT_PID### AND ' .
                    Answer::TABLE_NAME . '.sys_language_uid IN (-1,0)',
                'default' => 0
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
            ],
        ],
        'starttime' => [
            'l10n_mode' => 'exclude',
            'exclude' => true,
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'size' => 13,
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],
        'endtime' => [
            'l10n_mode' => 'exclude',
            'exclude' => true,
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'size' => 13,
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],
        'value' => [
            'exclude' => true,
            'label' => 'LLL:EXT:powermail/Resources/Private/Language/locallang_db.xlf:' . Answer::TABLE_NAME . '.value',
            'config' => [
                'type' => 'text',
                'cols' => 60,
                'rows' => 3
            ],
        ],
        'value_type' => [
            'exclude' => true,
            'label' => 'LLL:EXT:powermail/Resources/Private/Language/locallang_db.xlf:' .
                Answer::TABLE_NAME . '.value_type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    /**
                     * Text
                     */
                    [
                        'LLL:EXT:powermail/Resources/Private/Language/locallang_db.xlf:' .
                        Answer::TABLE_NAME . '.value_type.0',
                        '0'
                    ],
                    /**
                     * Multi Text (Array)
                     */
                    [
                        'LLL:EXT:powermail/Resources/Private/Language/locallang_db.xlf:' .
                        Answer::TABLE_NAME . '.value_type.1',
                        '1'
                    ],
                    /**
                     * Date
                     */
                    [
                        'LLL:EXT:powermail/Resources/Private/Language/locallang_db.xlf:' .
                        Answer::TABLE_NAME . '.value_type.2',
                        '2'
                    ],
                    /**
                     * Upload
                     */
                    [
                        'LLL:EXT:powermail/Resources/Private/Language/locallang_db.xlf:' .
                        Answer::TABLE_NAME . '.value_type.3',
                        '3'
                    ],
                ],
            ],
        ],
        'field' => [
            'exclude' => true,
            'label' => 'LLL:EXT:powermail/Resources/Private/Language/locallang_db.xlf:' . Answer::TABLE_NAME . '.field',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => Field::TABLE_NAME,
                'size' => 1,
                'maxitems' => 1,
                'multiple' => 0,
                'default' => 0
            ],
        ],
        'mail' => [
            'exclude' => true,
            'label' => 'LLL:EXT:powermail/Resources/Private/Language/locallang_db.xlf:' . Answer::TABLE_NAME . '.mail',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => Mail::TABLE_NAME,
                'size' => 1,
                'maxitems' => 1,
                'multiple' => 0,
                'default' => 0
            ],
        ],
    ],
];

return $answersTca;
