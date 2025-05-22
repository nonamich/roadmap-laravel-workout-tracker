import { queryParams, type QueryParams } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\WorkoutController::index
* @see app/Http/Controllers/WorkoutController.php:15
* @route '/workouts'
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
    url: '/workouts',
}

/**
* @see \App\Http\Controllers\WorkoutController::index
* @see app/Http/Controllers/WorkoutController.php:15
* @route '/workouts'
*/
index.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\WorkoutController::index
* @see app/Http/Controllers/WorkoutController.php:15
* @route '/workouts'
*/
index.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\WorkoutController::index
* @see app/Http/Controllers/WorkoutController.php:15
* @route '/workouts'
*/
index.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\WorkoutController::create
* @see app/Http/Controllers/WorkoutController.php:23
* @route '/workouts/create'
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
    url: '/workouts/create',
}

/**
* @see \App\Http\Controllers\WorkoutController::create
* @see app/Http/Controllers/WorkoutController.php:23
* @route '/workouts/create'
*/
create.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\WorkoutController::create
* @see app/Http/Controllers/WorkoutController.php:23
* @route '/workouts/create'
*/
create.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: create.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\WorkoutController::create
* @see app/Http/Controllers/WorkoutController.php:23
* @route '/workouts/create'
*/
create.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: create.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\WorkoutController::store
* @see app/Http/Controllers/WorkoutController.php:31
* @route '/workouts'
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
    url: '/workouts',
}

/**
* @see \App\Http\Controllers\WorkoutController::store
* @see app/Http/Controllers/WorkoutController.php:31
* @route '/workouts'
*/
store.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\WorkoutController::store
* @see app/Http/Controllers/WorkoutController.php:31
* @route '/workouts'
*/
store.post = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\WorkoutController::show
* @see app/Http/Controllers/WorkoutController.php:39
* @route '/workouts/{workout}'
*/
export const show = (args: { workout: number | { id: number } } | [workout: number | { id: number } ] | number | { id: number }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ['get','head'],
    url: '/workouts/{workout}',
}

/**
* @see \App\Http\Controllers\WorkoutController::show
* @see app/Http/Controllers/WorkoutController.php:39
* @route '/workouts/{workout}'
*/
show.url = (args: { workout: number | { id: number } } | [workout: number | { id: number } ] | number | { id: number }, options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { workout: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { workout: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            workout: args[0],
        }
    }

    const parsedArgs = {
        workout: typeof args.workout === 'object'
        ? args.workout.id
        : args.workout,
    }

    return show.definition.url
            .replace('{workout}', parsedArgs.workout.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\WorkoutController::show
* @see app/Http/Controllers/WorkoutController.php:39
* @route '/workouts/{workout}'
*/
show.get = (args: { workout: number | { id: number } } | [workout: number | { id: number } ] | number | { id: number }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\WorkoutController::show
* @see app/Http/Controllers/WorkoutController.php:39
* @route '/workouts/{workout}'
*/
show.head = (args: { workout: number | { id: number } } | [workout: number | { id: number } ] | number | { id: number }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: show.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\WorkoutController::edit
* @see app/Http/Controllers/WorkoutController.php:47
* @route '/workouts/{workout}/edit'
*/
export const edit = (args: { workout: number | { id: number } } | [workout: number | { id: number } ] | number | { id: number }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ['get','head'],
    url: '/workouts/{workout}/edit',
}

/**
* @see \App\Http\Controllers\WorkoutController::edit
* @see app/Http/Controllers/WorkoutController.php:47
* @route '/workouts/{workout}/edit'
*/
edit.url = (args: { workout: number | { id: number } } | [workout: number | { id: number } ] | number | { id: number }, options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { workout: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { workout: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            workout: args[0],
        }
    }

    const parsedArgs = {
        workout: typeof args.workout === 'object'
        ? args.workout.id
        : args.workout,
    }

    return edit.definition.url
            .replace('{workout}', parsedArgs.workout.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\WorkoutController::edit
* @see app/Http/Controllers/WorkoutController.php:47
* @route '/workouts/{workout}/edit'
*/
edit.get = (args: { workout: number | { id: number } } | [workout: number | { id: number } ] | number | { id: number }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: edit.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\WorkoutController::edit
* @see app/Http/Controllers/WorkoutController.php:47
* @route '/workouts/{workout}/edit'
*/
edit.head = (args: { workout: number | { id: number } } | [workout: number | { id: number } ] | number | { id: number }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: edit.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\WorkoutController::update
* @see app/Http/Controllers/WorkoutController.php:55
* @route '/workouts/{workout}'
*/
export const update = (args: { workout: number | { id: number } } | [workout: number | { id: number } ] | number | { id: number }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'put',
} => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ['put','patch'],
    url: '/workouts/{workout}',
}

/**
* @see \App\Http\Controllers\WorkoutController::update
* @see app/Http/Controllers/WorkoutController.php:55
* @route '/workouts/{workout}'
*/
update.url = (args: { workout: number | { id: number } } | [workout: number | { id: number } ] | number | { id: number }, options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { workout: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { workout: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            workout: args[0],
        }
    }

    const parsedArgs = {
        workout: typeof args.workout === 'object'
        ? args.workout.id
        : args.workout,
    }

    return update.definition.url
            .replace('{workout}', parsedArgs.workout.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\WorkoutController::update
* @see app/Http/Controllers/WorkoutController.php:55
* @route '/workouts/{workout}'
*/
update.put = (args: { workout: number | { id: number } } | [workout: number | { id: number } ] | number | { id: number }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'put',
} => ({
    url: update.url(args, options),
    method: 'put',
})

/**
* @see \App\Http\Controllers\WorkoutController::update
* @see app/Http/Controllers/WorkoutController.php:55
* @route '/workouts/{workout}'
*/
update.patch = (args: { workout: number | { id: number } } | [workout: number | { id: number } ] | number | { id: number }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'patch',
} => ({
    url: update.url(args, options),
    method: 'patch',
})

/**
* @see \App\Http\Controllers\WorkoutController::destroy
* @see app/Http/Controllers/WorkoutController.php:63
* @route '/workouts/{workout}'
*/
export const destroy = (args: { workout: number | { id: number } } | [workout: number | { id: number } ] | number | { id: number }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'delete',
} => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ['delete'],
    url: '/workouts/{workout}',
}

/**
* @see \App\Http\Controllers\WorkoutController::destroy
* @see app/Http/Controllers/WorkoutController.php:63
* @route '/workouts/{workout}'
*/
destroy.url = (args: { workout: number | { id: number } } | [workout: number | { id: number } ] | number | { id: number }, options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { workout: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { workout: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            workout: args[0],
        }
    }

    const parsedArgs = {
        workout: typeof args.workout === 'object'
        ? args.workout.id
        : args.workout,
    }

    return destroy.definition.url
            .replace('{workout}', parsedArgs.workout.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\WorkoutController::destroy
* @see app/Http/Controllers/WorkoutController.php:63
* @route '/workouts/{workout}'
*/
destroy.delete = (args: { workout: number | { id: number } } | [workout: number | { id: number } ] | number | { id: number }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'delete',
} => ({
    url: destroy.url(args, options),
    method: 'delete',
})

const WorkoutController = { index, create, store, show, edit, update, destroy }

export default WorkoutController