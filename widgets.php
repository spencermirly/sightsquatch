<?php

    enum Notify {
        case Default;
        case Success;
        case Fail;
    }
    class Widgets{
        public static function notify($message, $type = Notify::Default) {
            switch($type) {
                case Notify::Success:
                    return "<div class='notify-success'>$message</div>";
                case Notify::Fail:
                    return "<div class='notify-fail'>$message</div>";
                default:
                    return "<div class='notify'>$message</div>";
            }
        }
    }

?>