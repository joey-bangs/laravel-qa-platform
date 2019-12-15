<script>
    export default {
        name: "AnswerView",
        props: {
            answer: {
                type: Object,
                required: true
            }
        },
        data: function () {
            return {
                isEditing: false,
                slimAnswer: {
                    id: this.answer.id,
                    questionId: this.answer.question_id,
                    bodyHtml: this.answer.body_html,
                    body: this.answer.body
                },
                bodyFormValue: this.answer.body
            };
        },
        methods: {
            openEditAnswerForm: function () {
                this.isEditing = true;
            },
            updateAnswer: async function () {
                try {
                    const response = await axios.patch(
                        `/questions/${this.slimAnswer.questionId}/answers/${this.slimAnswer.id}`,
                        {body: this.bodyFormValue}
                    );

                    const answer = response.data.answer;

                    this.slimAnswer = {
                        id: answer.id,
                        questionId: answer.question_id,
                        bodyHtml: answer.body_html,
                        body: answer.body
                    };
                    this.bodyFormValue = answer.body;

                    this.isEditing = false;

                    alert('Successfully edited!');
                } catch (error) {
                    this.bodyFormValue = this.slimAnswer.body;

                    alert(error.response.data.message);
                }
            },
            cancelUpdateAnswer: function () {
                this.bodyFormValue = this.slimAnswer.body;
                this.isEditing = false;
            }
        },
        computed: {
            isFieldValid: function () {
                return this.bodyFormValue.trim().length > 0;
            },
            fieldClassStyleObject: function () {
                return {'is-invalid': !this.isFieldValid};
            }
        }
    }
</script>

