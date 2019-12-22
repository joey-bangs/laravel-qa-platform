export default class Question {
    static update(user, question) {
        return user.id === question.user_id;
    }

    static delete(user, question) {
        const isAnswered = question.answers_count > 0;

        const belongsToUser = user.id === question.user_id;

        return belongsToUser && !isAnswered;
    }
}
