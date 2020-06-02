export default class Answer {
    static update(user, answer) {
        return user.id === answer.user_id;
    }

    static accept(user, answer) {
        return user.is_counsellor;
    }

    static delete(user, answer) {
        return user.id === answer.user_id;
    }
}
