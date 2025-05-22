import { queryParams, type QueryParams } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\ExerciseController::index
* @see app/Http/Controllers/ExerciseController.php:25
* @route '/exercises'
*/
export const index = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ['get','head'],
    url: '/exercises',
}

/**
* @see \App\Http\Controllers\ExerciseController::index
* @see app/Http/Controllers/ExerciseController.php:25
* @route '/exercises'
*/
index.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\ExerciseController::index
* @see app/Http/Controllers/ExerciseController.php:25
* @route '/exercises'
*/
index.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\ExerciseController::index
* @see app/Http/Controllers/ExerciseController.php:25
* @route '/exercises'
*/
index.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\ExerciseController::create
* @see app/Http/Controllers/ExerciseController.php:43
* @route '/exercises/create'
*/
export const create = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ['get','head'],
    url: '/exercises/create',
}

/**
* @see \App\Http\Controllers\ExerciseController::create
* @see app/Http/Controllers/ExerciseController.php:43
* @route '/exercises/create'
*/
create.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\ExerciseController::create
* @see app/Http/Controllers/ExerciseController.php:43
* @route '/exercises/create'
*/
create.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: create.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\ExerciseController::create
* @see app/Http/Controllers/ExerciseController.php:43
* @route '/exercises/create'
*/
create.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: create.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\ExerciseController::store
* @see app/Http/Controllers/ExerciseController.php:51
* @route '/exercises'
*/
export const store = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ['post'],
    url: '/exercises',
}

/**
* @see \App\Http\Controllers\ExerciseController::store
* @see app/Http/Controllers/ExerciseController.php:51
* @route '/exercises'
*/
store.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\ExerciseController::store
* @see app/Http/Controllers/ExerciseController.php:51
* @route '/exercises'
*/
store.post = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\ExerciseController::show
* @see app/Http/Controllers/ExerciseController.php:0
* @route '/exercises/{exercise}'
*/
export const show = (args: { exercise: string | number } | [exercise: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ['get','head'],
    url: '/exercises/{exercise}',
}

/**
* @see \App\Http\Controllers\ExerciseController::show
* @see app/Http/Controllers/ExerciseController.php:0
* @route '/exercises/{exercise}'
*/
show.url = (args: { exercise: string | number } | [exercise: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { exercise: args }
    }

    if (Array.isArray(args)) {
        args = {
            exercise: args[0],
        }
    }

    const parsedArgs = {
        exercise: args.exercise,
    }

    return show.definition.url
            .replace('{exercise}', parsedArgs.exercise.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\ExerciseController::show
* @see app/Http/Controllers/ExerciseController.php:0
* @route '/exercises/{exercise}'
*/
show.get = (args: { exercise: string | number } | [exercise: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\ExerciseController::show
* @see app/Http/Controllers/ExerciseController.php:0
* @route '/exercises/{exercise}'
*/
show.head = (args: { exercise: string | number } | [exercise: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: show.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\ExerciseController::edit
* @see app/Http/Controllers/ExerciseController.php:69
* @route '/exercises/{exercise}/edit'
*/
export const edit = (args: { exercise: number | { id: number } } | [exercise: number | { id: number } ] | number | { id: number }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ['get','head'],
    url: '/exercises/{exercise}/edit',
}

/**
* @see \App\Http\Controllers\ExerciseController::edit
* @see app/Http/Controllers/ExerciseController.php:69
* @route '/exercises/{exercise}/edit'
*/
edit.url = (args: { exercise: number | { id: number } } | [exercise: number | { id: number } ] | number | { id: number }, options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { exercise: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { exercise: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            exercise: args[0],
        }
    }

    const parsedArgs = {
        exercise: typeof args.exercise === 'object'
        ? args.exercise.id
        : args.exercise,
    }

    return edit.definition.url
            .replace('{exercise}', parsedArgs.exercise.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\ExerciseController::edit
* @see app/Http/Controllers/ExerciseController.php:69
* @route '/exercises/{exercise}/edit'
*/
edit.get = (args: { exercise: number | { id: number } } | [exercise: number | { id: number } ] | number | { id: number }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: edit.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\ExerciseController::edit
* @see app/Http/Controllers/ExerciseController.php:69
* @route '/exercises/{exercise}/edit'
*/
edit.head = (args: { exercise: number | { id: number } } | [exercise: number | { id: number } ] | number | { id: number }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: edit.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\ExerciseController::update
* @see app/Http/Controllers/ExerciseController.php:79
* @route '/exercises/{exercise}'
*/
export const update = (args: { exercise: number | { id: number } } | [exercise: number | { id: number } ] | number | { id: number }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'put',
} => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ['put','patch'],
    url: '/exercises/{exercise}',
}

/**
* @see \App\Http\Controllers\ExerciseController::update
* @see app/Http/Controllers/ExerciseController.php:79
* @route '/exercises/{exercise}'
*/
update.url = (args: { exercise: number | { id: number } } | [exercise: number | { id: number } ] | number | { id: number }, options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { exercise: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { exercise: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            exercise: args[0],
        }
    }

    const parsedArgs = {
        exercise: typeof args.exercise === 'object'
        ? args.exercise.id
        : args.exercise,
    }

    return update.definition.url
            .replace('{exercise}', parsedArgs.exercise.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\ExerciseController::update
* @see app/Http/Controllers/ExerciseController.php:79
* @route '/exercises/{exercise}'
*/
update.put = (args: { exercise: number | { id: number } } | [exercise: number | { id: number } ] | number | { id: number }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'put',
} => ({
    url: update.url(args, options),
    method: 'put',
})

/**
* @see \App\Http\Controllers\ExerciseController::update
* @see app/Http/Controllers/ExerciseController.php:79
* @route '/exercises/{exercise}'
*/
update.patch = (args: { exercise: number | { id: number } } | [exercise: number | { id: number } ] | number | { id: number }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'patch',
} => ({
    url: update.url(args, options),
    method: 'patch',
})

/**
* @see \App\Http\Controllers\ExerciseController::destroy
* @see app/Http/Controllers/ExerciseController.php:92
* @route '/exercises/{exercise}'
*/
export const destroy = (args: { exercise: number | { id: number } } | [exercise: number | { id: number } ] | number | { id: number }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'delete',
} => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ['delete'],
    url: '/exercises/{exercise}',
}

/**
* @see \App\Http\Controllers\ExerciseController::destroy
* @see app/Http/Controllers/ExerciseController.php:92
* @route '/exercises/{exercise}'
*/
destroy.url = (args: { exercise: number | { id: number } } | [exercise: number | { id: number } ] | number | { id: number }, options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { exercise: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { exercise: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            exercise: args[0],
        }
    }

    const parsedArgs = {
        exercise: typeof args.exercise === 'object'
        ? args.exercise.id
        : args.exercise,
    }

    return destroy.definition.url
            .replace('{exercise}', parsedArgs.exercise.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\ExerciseController::destroy
* @see app/Http/Controllers/ExerciseController.php:92
* @route '/exercises/{exercise}'
*/
destroy.delete = (args: { exercise: number | { id: number } } | [exercise: number | { id: number } ] | number | { id: number }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'delete',
} => ({
    url: destroy.url(args, options),
    method: 'delete',
})

const ExerciseController = { index, create, store, show, edit, update, destroy }

export default ExerciseController