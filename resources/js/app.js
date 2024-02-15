import './bootstrap';
import '../css/app.css';
import $ from "jquery";

const RED = 0;
const YELLOW = 1;
const GREEN = 2;

const RED_TIME = 5000;
const YELLOW_TIME = 2000;
const GREEN_TIME = 5000;
const TOTAL_TIME = RED_TIME + GREEN_TIME + 2 * YELLOW_TIME;
$(document).ready(()=> {
    const start = new Date(start_at);

    /**
     * Calculates time diff and highlights the color
     */
    function highlightColor() {
        const diff = (new Date() - start) % TOTAL_TIME;

        let timeout;
        $('.light.selected').removeClass('selected');
        if (diff < YELLOW_TIME) {
            $(`.yellow.light`).addClass('selected');
            timeout = YELLOW_TIME - diff;
        } else if (diff < RED_TIME + YELLOW_TIME) {
            $(`.red.light`).addClass('selected');
            timeout = RED_TIME + YELLOW_TIME - diff;
        } else if (diff < RED_TIME + 2 * YELLOW_TIME) {
            $(`.yellow.light`).addClass('selected');
            timeout = RED_TIME + 2 * YELLOW_TIME - diff;
        } else {
            $(`.green.light`).addClass('selected');
            timeout = TOTAL_TIME - diff;
        }

        setTimeout(highlightColor, timeout);
    }

    highlightColor();


    $('#button').click(() => {
        $.get('/drive')
            .then(resp => {
                let messageDiv = $('.message');
                switch (resp.color) {
                    case RED:
                        messageDiv.text('Проезд на красный. Штраф!');
                        break;
                    case YELLOW:
                        if (resp.is_after_green) {
                            messageDiv.text('Успели на желтый!');
                        } else {
                            messageDiv.text('Слишком рано начали движение!');
                        }
                        break;
                    default:
                        messageDiv.text('Проезд на зёленый!');

                }
            })
    })
});
