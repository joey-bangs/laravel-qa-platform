export default class Question {
    static toggleFavourite(id) {
        return axios.patch(`/questions/${id}/toggle-favourite`);
    }
}
