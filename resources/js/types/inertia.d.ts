import type { PageProps as InertiaPageProps } from '@inertiajs/core';
import type { ShareData } from './laravel-data';

declare module '@inertiajs/core' {
  interface PageProps extends InertiaPageProps, ShareData {}
}
