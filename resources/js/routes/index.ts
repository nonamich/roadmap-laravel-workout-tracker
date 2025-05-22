import { queryParams, type QueryParams } from './../wayfinder'
/**
* @see \App\Http\Controllers\HomepageController::homepage
* @see app/Http/Controllers/HomepageController.php:9
* @route '/'
*/
export const homepage = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: homepage.url(options),
    method: 'get',
})

homepage.definition = {
    methods: ['get','head'],
    url: '/',
}

/**
* @see \App\Http\Controllers\HomepageController::homepage
* @see app/Http/Controllers/HomepageController.php:9
* @route '/'
*/
homepage.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return homepage.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\HomepageController::homepage
* @see app/Http/Controllers/HomepageController.php:9
* @route '/'
*/
homepage.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: homepage.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\HomepageController::homepage
* @see app/Http/Controllers/HomepageController.php:9
* @route '/'
*/
homepage.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: homepage.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Auth\LoginController::login
* @see app/Http/Controllers/Auth/LoginController.php:15
* @route '/login'
*/
export const login = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: login.url(options),
    method: 'get',
})

login.definition = {
    methods: ['get','head'],
    url: '/login',
}

/**
* @see \App\Http\Controllers\Auth\LoginController::login
* @see app/Http/Controllers/Auth/LoginController.php:15
* @route '/login'
*/
login.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return login.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Auth\LoginController::login
* @see app/Http/Controllers/Auth/LoginController.php:15
* @route '/login'
*/
login.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: login.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Auth\LoginController::login
* @see app/Http/Controllers/Auth/LoginController.php:15
* @route '/login'
*/
login.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: login.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Auth\RegisterController::register
* @see app/Http/Controllers/Auth/RegisterController.php:14
* @route '/register'
*/
export const register = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: register.url(options),
    method: 'get',
})

register.definition = {
    methods: ['get','head'],
    url: '/register',
}

/**
* @see \App\Http\Controllers\Auth\RegisterController::register
* @see app/Http/Controllers/Auth/RegisterController.php:14
* @route '/register'
*/
register.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return register.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Auth\RegisterController::register
* @see app/Http/Controllers/Auth/RegisterController.php:14
* @route '/register'
*/
register.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: register.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Auth\RegisterController::register
* @see app/Http/Controllers/Auth/RegisterController.php:14
* @route '/register'
*/
register.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: register.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Auth\LoginController::logout
* @see app/Http/Controllers/Auth/LoginController.php:38
* @route '/logout'
*/
export const logout = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: logout.url(options),
    method: 'post',
})

logout.definition = {
    methods: ['post'],
    url: '/logout',
}

/**
* @see \App\Http\Controllers\Auth\LoginController::logout
* @see app/Http/Controllers/Auth/LoginController.php:38
* @route '/logout'
*/
logout.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return logout.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Auth\LoginController::logout
* @see app/Http/Controllers/Auth/LoginController.php:38
* @route '/logout'
*/
logout.post = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: logout.url(options),
    method: 'post',
})

