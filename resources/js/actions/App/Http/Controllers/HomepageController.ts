import { queryParams, type QueryParams } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\HomepageController::show
* @see app/Http/Controllers/HomepageController.php:9
* @route '/'
*/
export const show = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: show.url(options),
    method: 'get',
})

show.definition = {
    methods: ['get','head'],
    url: '/',
}

/**
* @see \App\Http\Controllers\HomepageController::show
* @see app/Http/Controllers/HomepageController.php:9
* @route '/'
*/
show.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return show.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\HomepageController::show
* @see app/Http/Controllers/HomepageController.php:9
* @route '/'
*/
show.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: show.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\HomepageController::show
* @see app/Http/Controllers/HomepageController.php:9
* @route '/'
*/
show.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: show.url(options),
    method: 'head',
})

const HomepageController = { show }

export default HomepageController