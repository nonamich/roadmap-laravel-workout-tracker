import type { PageProps as InertiaPageProps } from '@inertiajs/core';
import type { ShareWebData } from './laravel-data';

declare module '@inertiajs/core' {
  interface PageProps extends InertiaPageProps, ShareWebData {}
}
