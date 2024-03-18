export interface PaginateType<T>{
    current_page: number;
    data: T[];
    first_page_url: string;
    from: number | null;
    last_page: number;
    links: {
        url: string;
        label: string;
        active: boolean;
    }[];
    last_page_url: string;
    next_page_url: string | null;
    path: string;
    per_page: number;
    prev_page_url: string | null;
    to: number | null;
    total: number;
}