import {
    http,
    httpFile
} from './http_services';

export function createCategory(data) {
    return httpFile().post("/category", data);
}
export function loadCategory() {
    return http().get("/category");
}
export function deleteCategory(id) {
    return http().delete(`/category/${id}`);
}
export function updateCategory(id, data) {
    return httpFile().post(`/category/${id}`, data);
}
