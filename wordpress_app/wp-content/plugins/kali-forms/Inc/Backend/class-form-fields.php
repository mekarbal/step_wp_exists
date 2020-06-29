<?php

namespace KaliForms\Inc\Backend;

if (!defined('ABSPATH')) {
    exit;
}

use KaliForms\Inc\Backend\BuilderFormFields;

/**
 * Class Form_Fields is used to translate stuff
 *
 * @package App\Libraries
 */
class Form_Fields
{
    /**
     * Plugin slug
     *
     * @var string
     */
    public $slug = 'kaliforms';
    /**
     * FormFields array
     *
     * @var array
     */
    public $form_fields = [];

    /**
     * Basic constructor
     *
     * Form fields constructor
     */
    public function __construct()
    {
        $this->form_fields = $this->set_form_fields();
    }

    /**
     * Set form fields
     *
     * @return array
     */
    public function set_form_fields()
    {
        $fields = [
            [
                'id' => 'standard',
                'label' => esc_html__('Standard fields', 'kaliforms'),
                'fields' => [
                    $this->textbox(),
                    $this->url(),
                    $this->email(),
                    $this->telephone(),
                    $this->textarea(),
                    $this->date(),
                    $this->dropdown(),
                    $this->checkbox(),
                    $this->radio(),
                    $this->divider(),
                    $this->free_text(),
                ],
            ],
            [
                'id' => 'advanced',
                'label' => esc_html__('Advanced', 'kaliforms'),
                'fields' => [
                    // $this->date_time_picker(),
                    $this->g_recaptcha(),
                    $this->file_upload(),
                    $this->hidden(),
                    $this->address(),
                ],
            ],
            [
                'id' => 'payments',
                'label' => esc_html__('Payments', 'kaliforms'),
                'fields' => [
                    $this->product_field(),
                    $this->paypal_field(),
                ],
            ],
            [
                'id' => 'buttons',
                'label' => esc_html__('Buttons', 'kaliforms'),
                'fields' => [
                    // $this->button(),
                    $this->submit_button(),
                ],
            ],
        ];

        $fields = $this->set_upsell_fields($fields);

        /**
         * We can add / remove fields through this filter
         */
        return apply_filters($this->slug . '_default_form_fields', $fields);
    }
    public function address()
    {
        return new BuilderFormFields\Collection([
            'label' => esc_html__('Address', 'kaliforms'),
            'fields' => [
                [
                    'field' => new BuilderFormFields\TextBox(
                        [
                            'type' => [
                                'label' => esc_html__('Field type', 'kaliforms'),
                                'type' => 'select',
                                'value' => 'text',
                                'choices' => ['text', 'number'],
                                'group' => 'advanced',
                            ],
                            'placeholder' => [
                                'label' => esc_html__('Field placeholder', 'kaliforms'),
                                'type' => 'textbox',
                                'value' => '',
                                'group' => 'general',
                            ],
                            'required' => [
                                'label' => esc_html__('Required', 'kaliforms'),
                                'type' => 'toggle',
                                'value' => false,
                                'group' => 'general',
                            ],
                            'readonly' => [
                                'label' => esc_html__('Readonly', 'kaliforms'),
                                'type' => 'toggle',
                                'value' => false,
                                'group' => 'advanced',
                            ],
                        ]
                    ),
                    'values' => [
                        'id' => 'street',
                        'name' => 'street',
                        'caption' => esc_html__('Address line 1', 'kaliforms'),
                    ],
                    'grid' => ['row' => 0, 'w' => 12],
                ],
                [
                    'field' => new BuilderFormFields\TextBox(
                        [
                            'type' => [
                                'label' => esc_html__('Field type', 'kaliforms'),
                                'type' => 'select',
                                'value' => 'text',
                                'choices' => ['text', 'number'],
                                'group' => 'advanced',
                            ],
                            'placeholder' => [
                                'label' => esc_html__('Field placeholder', 'kaliforms'),
                                'type' => 'textbox',
                                'value' => '',
                                'group' => 'general',
                            ],
                            'required' => [
                                'label' => esc_html__('Required', 'kaliforms'),
                                'type' => 'toggle',
                                'value' => false,
                                'group' => 'general',
                            ],
                            'readonly' => [
                                'label' => esc_html__('Readonly', 'kaliforms'),
                                'type' => 'toggle',
                                'value' => false,
                                'group' => 'advanced',
                            ],
                        ]
                    ),
                    'values' => [
                        'id' => 'street1',
                        'name' => 'street1',
                        'caption' => esc_html__('Address line 2', 'kaliforms'),
                    ],
                    'grid' => ['row' => 1, 'w' => 12],
                ],
                [
                    'field' => new BuilderFormFields\TextBox(
                        [
                            'type' => [
                                'label' => esc_html__('Field type', 'kaliforms'),
                                'type' => 'select',
                                'value' => 'text',
                                'choices' => ['text', 'number'],
                                'group' => 'advanced',
                            ],
                            'placeholder' => [
                                'label' => esc_html__('Field placeholder', 'kaliforms'),
                                'type' => 'textbox',
                                'value' => '',
                                'group' => 'general',
                            ],
                            'required' => [
                                'label' => esc_html__('Required', 'kaliforms'),
                                'type' => 'toggle',
                                'value' => false,
                                'group' => 'general',
                            ],
                            'readonly' => [
                                'label' => esc_html__('Readonly', 'kaliforms'),
                                'type' => 'toggle',
                                'value' => false,
                                'group' => 'advanced',
                            ],
                        ]
                    ),
                    'values' => [
                        'id' => 'city',
                        'name' => 'city',
                        'caption' => esc_html__('City', 'kaliforms'),
                    ],
                    'grid' => ['row' => 2, 'w' => 12],
                ],
                [
                    'field' => new BuilderFormFields\TextBox(
                        [
                            'type' => [
                                'label' => esc_html__('Field type', 'kaliforms'),
                                'type' => 'select',
                                'value' => 'text',
                                'choices' => ['text', 'number'],
                                'group' => 'advanced',
                            ],
                            'placeholder' => [
                                'label' => esc_html__('Field placeholder', 'kaliforms'),
                                'type' => 'textbox',
                                'value' => '',
                                'group' => 'general',
                            ],
                            'required' => [
                                'label' => esc_html__('Required', 'kaliforms'),
                                'type' => 'toggle',
                                'value' => false,
                                'group' => 'general',
                            ],
                            'readonly' => [
                                'label' => esc_html__('Readonly', 'kaliforms'),
                                'type' => 'toggle',
                                'value' => false,
                                'group' => 'advanced',
                            ],
                        ]
                    ),
                    'values' => [
                        'id' => 'state',
                        'name' => 'state',
                        'caption' => esc_html__('State', 'kaliforms'),
                    ],
                    'grid' => ['row' => 4, 'w' => 12],
                ],
                [
                    'field' => new BuilderFormFields\TextBox(
                        [
                            'type' => [
                                'label' => esc_html__('Field type', 'kaliforms'),
                                'type' => 'select',
                                'value' => 'text',
                                'choices' => ['text', 'number'],
                                'group' => 'advanced',
                            ],
                            'placeholder' => [
                                'label' => esc_html__('Field placeholder', 'kaliforms'),
                                'type' => 'textbox',
                                'value' => '',
                                'group' => 'general',
                            ],
                            'required' => [
                                'label' => esc_html__('Required', 'kaliforms'),
                                'type' => 'toggle',
                                'value' => false,
                                'group' => 'general',
                            ],
                            'readonly' => [
                                'label' => esc_html__('Readonly', 'kaliforms'),
                                'type' => 'toggle',
                                'value' => false,
                                'group' => 'advanced',
                            ],
                        ]
                    ),
                    'values' => [
                        'id' => 'zipCode',
                        'name' => 'zipCode',
                        'caption' => esc_html__('Zip Code', 'kaliforms'),
                    ],
                    'grid' => ['row' => 3, 'w' => 12],
                ],
                [
                    'field' => new BuilderFormFields\Dropdown(
                        [
                            'default' => [
                                'label' => esc_html__('Default value', 'kaliforms'),
                                'type' => 'hidden',
                                'value' => '',
                                'group' => 'addable',
                            ],
                            'choices' => [
                                'label' => esc_html__('Choices', 'kaliforms'),
                                'type' => 'addableList',
                                'value' => [
                                    ['value' => '', 'label' => esc_html__('Please select a country ...', 'kaliforms')],
                                ],
                                'group' => 'addable',
                            ],
                            'required' => [
                                'label' => esc_html__('Required', 'kaliforms'),
                                'type' => 'toggle',
                                'value' => false,
                                'group' => 'general',
                            ],
                            'readonly' => [
                                'label' => esc_html__('Readonly', 'kaliforms'),
                                'type' => 'toggle',
                                'value' => false,
                                'group' => 'advanced',
                            ],
                        ]
                    ),
                    'values' => [
                        'id' => 'state',
                        'name' => 'state',
                        'caption' => esc_html__('State', 'kaliforms'),
                    ],
                    'grid' => ['row' => 3, 'w' => 12],
                ],
            ],
        ]);
    }
    /**
     * Product field ( product selection )
     *
     * @return void
     */
    public function product_field()
    {
        return new BuilderFormFields\Product([
            'price' => [
                'label' => esc_html__('Price', 'kaliforms'),
                'type' => 'textbox',
                'value' => '',
            ],
            // 'picture' => [
            //     'label' => 'Picture',
            //     'type' => 'upload',
            //     'value' => '',
            // ],
        ]);
    }
    /**
     * PayPal Field
     *
     * @return void
     */
    public function paypal_field()
    {
        return new BuilderFormFields\PayPal([
            'merchantEmail' => [
                'label' => esc_html__('Merchant email', 'kaliforms'),
                'type' => 'textbox',
                'value' => '',
            ],
        ]);
    }
    /**
     * Hidden field
     *
     * @return void
     */
    protected function hidden()
    {
        return new BuilderFormFields\Hidden([]);
    }

    /**
     * Freetext field
     *
     * @return void
     */
    protected function free_text()
    {
        return new BuilderFormFields\FreeText(
            [
                'content' => [
                    'label' => esc_html__('Content', 'kaliforms'),
                    'type' => 'textarea',
                    'value' => '',
                ],
                'triggerShortcode' => [
                    'label' => esc_html__('Trigger shortcodes', 'kaliforms'),
                    'type' => 'toggle',
                    'value' => false,
                    'group' => 'advanced',
                ],
            ]
        );
    }

    /**
     * Divider field
     *
     * @return BuilderFormFields\Divider
     */
    protected function divider()
    {
        return new BuilderFormFields\Divider(
            [
                'type' => [
                    'label' => esc_html__('Divider type', 'kaliforms'),
                    'type' => 'select',
                    'value' => 'line',
                    'choices' => ['line', 'space', 'both'],
                ],
            ]
        );
    }

    /**
     * Google recaptcha field
     *
     * @return BuilderFormFields\GRecaptcha
     */
    protected function g_recaptcha()
    {
        return new BuilderFormFields\GRecaptcha([]);
    }
    /**
     * Date field
     *
     * @return void
     */
    protected function date()
    {
        return new BuilderFormFields\Date([
            'required' => [
                'label' => esc_html__('Required', 'kaliforms'),
                'type' => 'toggle',
                'value' => false,
            ],
            'readonly' => [
                'label' => esc_html__('Readonly', 'kaliforms'),
                'type' => 'toggle',
                'value' => false,
            ],
        ]);
    }

    /**
     * @return BuilderFormFields\File_Upload
     */
    protected function file_upload()
    {
        return new BuilderFormFields\File_Upload(
            [
                'default' => [
                    'label' => esc_html__('Default value', 'kaliforms'),
                    'type' => 'hidden',
                    'value' => '',
                    'group' => 'advanced',
                ],
                'maxFileSize' => [
                    'label' => sprintf(esc_html__('Max file size (e.g. %s)', 'kaliforms'), $this->getMaximumFileUploadSize()),
                    'type' => 'textbox',
                    'value' => '',
                    'group' => 'advanced',
                ],
                'acceptedExtensions' => [
                    'label' => esc_html__('Accepted extensions, separated by comma', 'kaliforms'),
                    'type' => 'textbox',
                    'value' => '',
                    'group' => 'advanced',
                ],
                'filePrefix' => [
                    'label' => esc_html__('File prefix', 'kaliforms'),
                    'type' => 'textbox',
                    'value' => '',
                    'group' => 'advanced',
                ],
                'instantUpload' => [
                    'label' => esc_html__('Instant Upload', 'kaliforms'),
                    'type' => 'toggle',
                    'value' => true,
                    'group' => 'advanced',
                ],
                'imagePreview' => [
                    'label' => esc_html__('Image preview', 'kaliforms'),
                    'type' => 'toggle',
                    'value' => false,
                    'group' => 'advanced',
                ],
                'required' => [
                    'label' => esc_html__('Required', 'kaliforms'),
                    'type' => 'toggle',
                    'value' => false,
                    'group' => 'general',
                ],
                'readonly' => [
                    'label' => esc_html__('Readonly', 'kaliforms'),
                    'type' => 'toggle',
                    'value' => false,
                    'group' => 'advanced',
                ],
            ]
        );
    }

    /**
     * @return BuilderFormFields\Dropdown
     */
    protected function dropdown()
    {
        return new BuilderFormFields\Dropdown(
            [
                'default' => [
                    'label' => esc_html__('Default value', 'kaliforms'),
                    'type' => 'hidden',
                    'value' => '',
                    'group' => 'addable',
                ],
                'choices' => [
                    'label' => esc_html__('Choices', 'kaliforms'),
                    'type' => 'addableList',
                    'value' => [],
                    'group' => 'addable',
                ],
                'required' => [
                    'label' => esc_html__('Required', 'kaliforms'),
                    'type' => 'toggle',
                    'value' => false,
                    'group' => 'general',
                ],
                'readonly' => [
                    'label' => esc_html__('Readonly', 'kaliforms'),
                    'type' => 'toggle',
                    'value' => false,
                    'group' => 'advanced',
                ],
            ]
        );
    }

    /**
     * @return BuilderFormFields\Checkbox
     */
    protected function checkbox()
    {
        return new BuilderFormFields\Checkbox(
            [
                'default' => [
                    'label' => esc_html__('Default value', 'kaliforms'),
                    'type' => 'hidden',
                    'value' => '',
                    'group' => 'addable',
                ],
                'flow' => [
                    'label' => esc_html__('Flow', 'kaliforms'),
                    'type' => 'select',
                    'value' => 'vertical',
                    'choices' => [
                        'vertical',
                        'horizontal',
                    ],
                    'group' => 'general',
                ],
                'choices' => [
                    'label' => esc_html__('Choices', 'kaliforms'),
                    'type' => 'addableList',
                    'value' => [],
                    'group' => 'addable',
                ],
                'required' => [
                    'label' => esc_html__('Required', 'kaliforms'),
                    'type' => 'toggle',
                    'value' => false,
                    'group' => 'general',
                ],
                'readonly' => [
                    'label' => esc_html__('Readonly', 'kaliforms'),
                    'type' => 'toggle',
                    'value' => false,
                    'group' => 'advanced',
                ],
            ]
        );
    }

    /**
     * @return BuilderFormFields\Radio
     */
    protected function radio()
    {
        return new BuilderFormFields\Radio(
            [
                'default' => [
                    'label' => esc_html__('Default value', 'kaliforms'),
                    'type' => 'hidden',
                    'value' => '',
                    'group' => 'addable',
                ],
                'flow' => [
                    'label' => esc_html__('Flow', 'kaliforms'),
                    'type' => 'select',
                    'value' => 'vertical',
                    'choices' => [
                        'vertical',
                        'horizontal',
                    ],
                    'group' => 'general',
                ],
                'choices' => [
                    'label' => esc_html__('Choices', 'kaliforms'),
                    'type' => 'addableList',
                    'value' => [],
                    'group' => 'addable',
                ],
                'required' => [
                    'label' => esc_html__('Required', 'kaliforms'),
                    'type' => 'toggle',
                    'value' => false,
                    'group' => 'general',
                ],
                'readonly' => [
                    'label' => esc_html__('Readonly', 'kaliforms'),
                    'type' => 'toggle',
                    'value' => false,
                    'group' => 'advanced',
                ],
            ]
        );
    }

    /**
     * @return BuilderFormFields\Submit_Button
     */
    protected function submit_button()
    {
        return new BuilderFormFields\Submit_Button([]);
    }

    /**
     * @return BuilderFormFields\Button
     */
    protected function button()
    {
        return new BuilderFormFields\Button([]);
    }

    /**
     * @return BuilderFormFields\TextArea
     */
    protected function textarea()
    {
        return new BuilderFormFields\TextArea(
            [
                'placeholder' => [
                    'label' => esc_html__('Field placeholder', 'kaliforms'),
                    'type' => 'textbox',
                    'value' => '',
                    'group' => 'general',
                ],
                'rows' => [
                    'label' => esc_html__('Rows', 'kaliforms'),
                    'type' => 'number',
                    'value' => 5,
                    'group' => 'general',
                ],
                'changeToEditor' => [
                    'label' => esc_html__('Transform to WYSIWYG?', 'kaliforms'),
                    'type' => 'toggle',
                    'value' => false,
                    'group' => 'general',
                ],
                'required' => [
                    'label' => esc_html__('Required', 'kaliforms'),
                    'type' => 'toggle',
                    'value' => false,
                    'group' => 'general',
                ],
                'readonly' => [
                    'label' => esc_html__('Readonly', 'kaliforms'),
                    'type' => 'toggle',
                    'value' => false,
                    'group' => 'advanced',
                ],
            ]
        );
    }

    /**
     * @return BuilderFormFields\TextBox
     */
    protected function textbox()
    {
        return new BuilderFormFields\TextBox(
            [
                'type' => [
                    'label' => esc_html__('Field type', 'kaliforms'),
                    'type' => 'select',
                    'value' => 'text',
                    'choices' => ['text', 'number'],
                    'group' => 'advanced',
                ],
                'placeholder' => [
                    'label' => esc_html__('Field placeholder', 'kaliforms'),
                    'type' => 'textbox',
                    'value' => '',
                    'group' => 'general',
                ],
                'required' => [
                    'label' => esc_html__('Required', 'kaliforms'),
                    'type' => 'toggle',
                    'value' => false,
                    'group' => 'general',
                ],
                'readonly' => [
                    'label' => esc_html__('Readonly', 'kaliforms'),
                    'type' => 'toggle',
                    'value' => false,
                    'group' => 'advanced',
                ],
            ]
        );
    }

    /**
     * @return BuilderFormFields\Telephone
     */
    protected function telephone()
    {
        return new BuilderFormFields\Telephone(
            [
                'placeholder' => [
                    'label' => esc_html__('Field placeholder', 'kaliforms'),
                    'type' => 'textbox',
                    'value' => '',
                    'group' => 'general',
                ],
                'required' => [
                    'label' => esc_html__('Required', 'kaliforms'),
                    'type' => 'toggle',
                    'value' => false,
                    'group' => 'general',
                ],
                'format' => [
                    'label' => esc_html__('Format', 'kaliforms'),
                    'type' => 'select',
                    'value' => 'free',
                    'choices' => [
                        'free' => esc_html__('No format', 'kaliforms'),
                        'us' => esc_html__('United States format', 'kaliforms'),
                        'usWithCode' => esc_html__('United States format with country code', 'kaliforms'),
                        'international' => esc_html__('International format', 'kaliforms'),
                    ],
                    'group' => 'advanced',
                ],
                'readonly' => [
                    'label' => esc_html__('Readonly', 'kaliforms'),
                    'type' => 'toggle',
                    'value' => false,
                    'group' => 'advanced',
                ],
            ]
        );
    }

    /**
     * @return BuilderFormFields\Email
     */
    protected function email()
    {
        return new BuilderFormFields\Email(
            [
                'placeholder' => [
                    'label' => esc_html__('Field placeholder', 'kaliforms'),
                    'type' => 'textbox',
                    'value' => '',
                    'group' => 'general',
                ],
                'required' => [
                    'label' => esc_html__('Required', 'kaliforms'),
                    'type' => 'toggle',
                    'value' => false,
                    'group' => 'general',
                ],
                'readonly' => [
                    'label' => esc_html__('Readonly', 'kaliforms'),
                    'type' => 'toggle',
                    'value' => false,
                    'group' => 'advanced',
                ],
            ]
        );
    }

    /**
     * @return BuilderFormFields\URL
     */
    protected function url()
    {
        return new BuilderFormFields\URL(
            [
                'placeholder' => [
                    'label' => esc_html__('Field placeholder', 'kaliforms'),
                    'type' => 'textbox',
                    'value' => '',
                    'group' => 'general',
                ],
                'required' => [
                    'label' => esc_html__('Required', 'kaliforms'),
                    'type' => 'toggle',
                    'value' => false,
                    'group' => 'general',
                ],
                'readonly' => [
                    'label' => esc_html__('Readonly', 'kaliforms'),
                    'type' => 'toggle',
                    'value' => false,
                    'group' => 'advanced',
                ],
            ]
        );
    }

    /**
     * Adds the upsell fields
     *
     * @param [type] $fields
     * @return void
     */
    protected function set_upsell_fields($fields)
    {
        if (defined('KALIFORMS_PRO_BASE')) {
            return $fields;
        }
        $fields[1]['fields'][] = new BuilderFormFields\Upsell_Field([
            'label' => esc_html__('Rating', 'kaliforms'),
            'upsell_for' => 'rating',
            'pro' => true,
        ]);

        $fields[1]['fields'][] = new BuilderFormFields\Upsell_Field([
            'label' => esc_html__('Smart Text Output', 'kaliforms'),
            'upsell_for' => 'smartTextOutput',
            'pro' => true,
        ]);
        $fields[1]['fields'][] = new BuilderFormFields\Upsell_Field([
            'label' => esc_html__('Range', 'kaliforms'),
            'upsell_for' => 'range',
            'pro' => true,
        ]);
        $fields[1]['fields'][] = new BuilderFormFields\Upsell_Field([
            'label' => esc_html__('Date Time Picker', 'kaliforms'),
            'upsell_for' => 'dateTimePicker',
            'pro' => true,
        ]);
        $fields[1]['fields'][] = new BuilderFormFields\Upsell_Field([
            'label' => esc_html__('Choices', 'kaliforms'),
            'upsell_for' => 'choices',
            'pro' => true,
        ]);
        $fields[1]['fields'][] = new BuilderFormFields\Upsell_Field([
            'label' => esc_html__('Page Break', 'kaliforms'),
            'upsell_for' => 'dateTimePicker',
            'pro' => true,
        ]);
        $fields[1]['fields'][] = new BuilderFormFields\Upsell_Field([
            'label' => esc_html__('Password', 'kaliforms'),
            'upsell_for' => 'password',
            'pro' => true,
        ]);

        return $fields;
    }
    /**
     * This function returns the maximum files size that can be uploaded
     * in PHP
     * @returns int File size in bytes
     **/
    public function getMaximumFileUploadSize()
    {
        return min((ini_get('post_max_size')), (ini_get('upload_max_filesize')));
    }
}
