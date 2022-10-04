require('./bootstrap');
const $ = require('jQuery');

$(() => {
    if (location.href.search('users-ajax') > 0) {
        axios.get('/api/user/1').then((response) => {
            $('.js-loading').addClass('hidden');
            $('.js-content').removeClass('hidden');
            populateData(response.data.data);

        });

        const populateData = ({img, name, comments}) => {
            $('.js-image').attr('src', img);
            $('.js-name').text(name);
            const comments_map = comments.map((val) => {
                return '<p>' + val + '</p>';
            });
            $('.js-comment-lists').html(comments_map);
        }

        /**
         * Comment for by ID
         *
         * @param e
         *
         * @returns {Promise<void>}
         */
        const commentFormSubmitHandler = async (e) => {
            e.preventDefault();
            const form_data = $(e.target).serializeArray().filter((val, key) => {
                return val.name !== '_method' && val.name !== '_token'
            });
            const form_data_object = {};
            const jsSubmitBtn = $('.js-submit-btn');
            for (let index in form_data) {
                form_data_object[form_data[index].name] = form_data[index].value;
            }

            try {
                $('.js-loading').removeClass('hidden');
                $('.js-content').addClass('hidden');
                $('.invalid-feedback').html('');
                jsSubmitBtn.prop('disabled', true);
                jsSubmitBtn.text('Submitting...');
                $('input, textarea').removeClass('invalid');
                const result = (await axios.put('/api/user',
                    form_data_object,
                    {
                        headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').val()
                        }
                    }
                ));
                populateData(result.data.data);
                $('input[type="text"], input[type="password"], textarea').val('');
            } catch (err) {
                if (err.response.status === 422) {
                    const errors = err.response.data.errors;
                    for (let errorkey in errors) {
                        $(`.invalid-feedback-${errorkey}`).html(errors[errorkey]);
                        $(`#${errorkey}`).addClass('invalid');
                    }
                }
            } finally {
                jsSubmitBtn.prop('disabled', false);
                jsSubmitBtn.text('Submit');
                $('.js-loading').addClass('hidden');
                $('.js-content').removeClass('hidden');
            }
        }

        $(document).on('submit', '#commentForm', commentFormSubmitHandler);
    }
});
