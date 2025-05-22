import { queryParams, type QueryParams } from './../../../../wayfinder';
/**
 * @see \App\Http\Controllers\DashboardController::show
 * @see app/Http/Controllers/DashboardController.php:10
 * @route '/dashboard'
 */
export const show = (options?: {
    query?: QueryParams;
    mergeQuery?: QueryParams;
}): {
    url: string;
    method: 'get';
} => ({
    url: show.url(options),
    method: 'get',
});

show.definition = {
    methods: ['get', 'head'],
    url: '/dashboard',
};

/**
 * @see \App\Http\Controllers\DashboardController::show
 * @see app/Http/Controllers/DashboardController.php:10
 * @route '/dashboard'
 */
show.url = (options?: { query?: QueryParams; mergeQuery?: QueryParams }) => {
    return show.definition.url + queryParams(options);
};

/**
 * @see \App\Http\Controllers\DashboardController::show
 * @see app/Http/Controllers/DashboardController.php:10
 * @route '/dashboard'
 */
show.get = (options?: {
    query?: QueryParams;
    mergeQuery?: QueryParams;
}): {
    url: string;
    method: 'get';
} => ({
    url: show.url(options),
    method: 'get',
});

/**
 * @see \App\Http\Controllers\DashboardController::show
 * @see app/Http/Controllers/DashboardController.php:10
 * @route '/dashboard'
 */
show.head = (options?: {
    query?: QueryParams;
    mergeQuery?: QueryParams;
}): {
    url: string;
    method: 'head';
} => ({
    url: show.url(options),
    method: 'head',
});

const DashboardController = { show };

export default DashboardController;
