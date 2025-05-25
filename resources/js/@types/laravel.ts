export type PaginatedCollection<T extends object = object> = {
  data: T[];
  links: Array<{ url: string | null; label: string; active: boolean }>;
  meta: {
    current_page: number;
    first_page_url: string | null;
    from: number;
    last_page: number;
    last_page_url: string | null;
    next_page_url: string | null;
    path: string;
    per_page: string;
    prev_page_url: string | null;
    to: number;
    total: number;
  };
};
