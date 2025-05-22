import { PageProps as InertiaPageProps } from '@inertiajs/core';

type AppPageProps = {
    user?: {
        id: number;
        name: string;
        email: string;
    } | null;
};

declare module '@inertiajs/core' {
    interface PageProps extends InertiaPageProps, AppPageProps {}
}
