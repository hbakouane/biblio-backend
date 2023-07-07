<?php

return [
    'response' => [
        'success' => 'Operation was completed successfully.',
        'failure' => 'Something went wrong.',
        'invalid' => 'Invalid response from server.',
        'not_found' => 'Content not found.'
    ],

    'auth' => [
        'register' => [
            'success' => 'User was registered successfully.'
        ],

        'login' => [
            'success' => 'User was logged in successfully.',
            'failure' => 'The given credentials are wrong.',
            'unauthorized' => 'You are unauthorized to login due to account suspension or inactivation.'
        ]
    ],

    'mail' => [
        'welcome' => [
            'welcome' => 'Welcome to ' . config('app.name') . ', :name!',
            'content' => '<b>Hi :name</b>, <br /><br /> We\'ve got great news, your new account has been activated. You can visit our online library and start buying your favourite books!'
        ],
        'discover_books' => 'Discover our books',
        'update_quantity' => 'Add more copies',
        'low_quantity_reminder' => 'Your book is getting out of stock, JUST :quantity LEFT',
        'item_out_of_stock' => '[IMPORTANT]: Your book has been out of stock',
        'reminder_subject' => 'Dear :name, your order is still awaiting for checkout',
        'reminder_body' => 'Your new books are still awaiting for you.',
        'checkout_now' => 'Checkout Now'
    ],

    'user' => [
        'settings' => [
            'profile_photo_uploaded' => 'Profile photo was uploaded successfully.',
            'profile_photo_deleted' => 'Profile photo was deleted successfully.',
            'profile_photo_doesnt_exist' => 'This user doesn\'t have a profile photo.'
        ]
    ],

    'category' => [
        'add' => [
            'added' => 'Category was added successfully.'
        ],

        'update' => [
            'updated' => 'Category was updated successfully.',
            'status' => [
                'updated' => 'Category\'s status was updated successfully.'
            ]
        ],

        'delete' => [
            'deleted' => 'Category was deleted successfully.'
        ]
    ],

    'book' => [
        'add' => [
            'added' => 'Book was added successfully.'
        ],

        'update' => [
            'updated' => 'Book was updated successfully.'
        ],

        'delete' => [
            'deleted' => 'Book was deleted successfully.'
        ]
    ],

    'order' => [
        'add' => [
            'added' => 'Order was added successfully.',
            'items' => [
                'attach' => [
                    'attached' => 'Items were added to order successfully.',
                    'quantity_not_available' => 'The given quantity is not available for this item.'
                ]
            ]
        ],

        'total' => 'Total',
        'quantity' => 'Quantity'
    ],

    'activity' => [
        'add' => [
            'added' => 'Activity was added successfully.'
        ]
    ]
];
