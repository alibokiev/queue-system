<?php

return [
    'body' => [

        /*
         | Background color of monitor
         */
        'background-color' => '',

        /*
         * You can add different styles as you would put in styles tag in html
         *
         * styles="font-size: 60px; color: red"
         */
        'other-styles' => ''
    ],

    /*
     * Only up to three columns can be, you can set them here
     */
    'columns' => [
        'first' => [
            'enable' => true,
            'title' => 'Очередь в зале'
        ],
        'second' => [
            'enable' => true,
            'title' => 'Очередь на кассу'
        ],
        'third' => [
            'enable' => false,
            'title' => 'Очередь в зале'
        ]
    ]
];
