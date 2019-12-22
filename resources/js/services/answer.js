export default class Answer {
    static delete(questionId, answerId) {
        return axios.delete(`/questions/${questionId}/answers/${answerId}`);
    }

    static update(questionId, answerId, data) {
        return axios.patch(
            `/questions/${questionId}/answers/${answerId}`,
            data
        );
    }

    static accept(id) {
        return axios.post(`/answers/${id}/accept`);
    }
}
