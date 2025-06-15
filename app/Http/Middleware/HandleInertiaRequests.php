<?php

namespace App\Http\Middleware;

use App\Data\Notifications\NotificationData;
use App\Data\ShareData;
use App\Data\UserShareData;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Spatie\LaravelData\DataCollection;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $defaultShareData = parent::share($request);
        $user = $request->user();
        $shareData = new ShareData(
            // @phpstan-ignore argument.type
            flash: $request->session()->get('message'),
            user: $user ? UserShareData::from($user) : null,
            notifications: NotificationData::collect(
                $user ? $user->notifications()->get() : [],
                DataCollection::class
            )
        );

        return [...$defaultShareData, ...$shareData->toArray()];
    }
}
