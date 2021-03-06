<?php


//use example\Mutation\ExampleMutation;
//use example\Query\ExampleQuery;
//use example\Type\ExampleRelationType;
//use example\Type\ExampleType;

return [

    // The prefix for routes
    'prefix' => 'graphql',

    // The routes to make GraphQL request. Either a string that will apply
    // to both query and mutation or an array containing the key 'query' and/or
    // 'mutation' with the according Route
    //
    // Example:
    //
    // Same route for both query and mutation
    //
    // 'routes' => 'path/to/query/{graphql_schema?}',
    //
    // or define each route
    //
    // 'routes' => [
    //     'query' => 'query/{graphql_schema?}',
    //     'mutation' => 'mutation/{graphql_schema?}',
    // ]
    //
    'routes' => '{graphql_schema?}',

    // The controller to use in GraphQL request. Either a string that will apply
    // to both query and mutation or an array containing the key 'query' and/or
    // 'mutation' with the according Controller and method
    //
    // Example:
    //
    // 'controllers' => [
    //     'query' => '\Rebing\GraphQL\GraphQLController@query',
    //     'mutation' => '\Rebing\GraphQL\GraphQLController@mutation'
    // ]
    //
    'controllers' => \Rebing\GraphQL\GraphQLController::class . '@query',

    // Any middleware for the graphql route group
    'middleware' => [],

    // The name of the default schema used when no argument is provided
    // to GraphQL::schema() or when the route is used without the graphql_schema
    // parameter.
    'default_schema' => 'default',

    // The schemas for query and/or mutation. It expects an array of schemas to provide
    // both the 'query' fields and the 'mutation' fields.
    //
    // You can also provide a middleware that will only apply to the given schema
    //
    // Example:
    //
    //  'schema' => 'default',
    //
    //  'schemas' => [
    //      'default' => [
    //          'query' => [
    //              'users' => 'App\GraphQL\Query\UsersQuery'
    //          ],
    //          'mutation' => [
    //
    //          ]
    //      ],
    //      'user' => [
    //          'query' => [
    //              'profile' => 'App\GraphQL\Query\ProfileQuery'
    //          ],
    //          'mutation' => [
    //
    //          ],
    //          'middleware' => ['auth'],
    //      ]
    //  ]
    //
    'schemas' => [
        'default' => [
            'query' => [
//                'example_query' => ExampleQuery::class,
//            Personal
                'personal' => \App\GraphQL\Query\personal\PersonalQuery::class,
                'personals' => \App\GraphQL\Query\personal\PersonalsQuery::class,
//            Usuario
                'usuario' => \App\GraphQL\Query\auth\user\UserQuery::class,
                'usuarios'=>\App\GraphQL\Query\auth\user\UsersQuery::class,
            ],
            'mutation' => [
//                'example_mutation'  => ExampleMutation::class,
//            Personal
                'updatePersonal' => \App\GraphQL\Mutation\Personal\UpdatePersonalMutation::class,
                'createPersonal' => \App\GraphQL\Mutation\Personal\CreatePersonalMutation::class,
                'deletePersonal' => \App\GraphQL\Mutation\Personal\DestroyPersonalMutation::class,
                'restorePersonal' => \App\GraphQL\Mutation\Personal\RestorePersonalMutation::class,

                'updatePersonalUsuario' => \App\GraphQL\Mutation\Personal\user\UpdatePersonalUserMutation::class,
                'restorePersonalUsuario' => \App\GraphQL\Mutation\Personal\user\RestorePersonalUserMutation::class,
            ],
            'middleware' => []
        ],
    ],

    // The types available in the application. You can then access it from the
    // facade like this: GraphQL::type('user')
    //
    // Example:
    //
    // 'types' => [
    //     'user' => 'App\GraphQL\Type\UserType'
    // ]
    //
    'types' => [
//        'login' => \App\GraphQL\Type\auth\LoginType::class,
//        'permission' => \App\GraphQL\Type\auth\PermissionType::class,
        'personal' => \App\GraphQL\Type\PersonalType::class,
//        'rol' => \App\GraphQL\Type\auth\RolType::class,
        'user' => \App\GraphQL\Type\auth\UserType::class,

//        'example'           => ExampleType::class,
//        'relation_example'  => ExampleRelationType::class,
    ],

    // This callable will be passed the Error object for each errors GraphQL catch.
    // The method should return an array representing the error.
    // Typically:
    // [
    //     'message' => '',
    //     'locations' => []
    // ]
    'error_formatter' => ['\Rebing\GraphQL\GraphQL', 'formatError'],

    // You can set the key, which will be used to retrieve the dynamic variables
    'params_key' => 'params',

];
