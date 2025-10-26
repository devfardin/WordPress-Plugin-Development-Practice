<?php
class Dashboard_currency_widget
{
    public function __construct()
    {

        add_action('wp_dashboard_setup', [$this, 'dashboard_currency_widget',]);
        add_action('wp_ajax_currency', [$this, 'get_currency_rates']);

    }
    public function dashboard_currency_widget()
    {
        wp_add_dashboard_widget('currency_widget', 'Currency Converter', [$this, 'rander_currency_widget']);
    }
    public function rander_currency_widget()
    {
        ?>
        <style>
            #currency-converter-btn {
                background: #007cba;
                color: white;
                padding: 15px 20px;
                border: none;
                border-radius: 6px;
                font-size: 15px;
                font-weight: 500;
            }

            #currency-converter-btn:hover {
                background: #005a87;
                cursor: pointer;
            }

            #currency-converter-result {
                margin-top: 10px;
            }



            body {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                background: #f7f9fc;
            }

            .loader {
                width: 70px;
                height: 70px;
                border-radius: 50%;
                border: 6px solid #ddd;
                border-top-color: #007bff;
                animation: spin 1s linear infinite;
                position: relative;
            }

            /* Glowing pulse ring */
            .loader::after {
                content: "";
                position: absolute;
                inset: 0;
                border-radius: 50%;
                border: 6px solid rgba(0, 123, 255, 0.4);
                animation: pulse 1.5s ease-out infinite;
            }

            @keyframes spin {
                to {
                    transform: rotate(360deg);
                }
            }

            @keyframes pulse {
                0% {
                    transform: scale(1);
                    opacity: 1;
                }

                100% {
                    transform: scale(1.5);
                    opacity: 0;
                }
            }
            .rates_items_wrap{
                display: flex;
                gap: 10px;
                flex-direction: column;
            }
            .rates_items_wrap li{
                font-size: 18px;
                font-weight: 500px;
            }
            .rates_items_wrap li span{
                color: #008000;
                background: #0080001f;
                padding: 5px;
                border-radius: 5px;
                font-weight: 600;
            }
        </style>
        <p><button id="currency-converter-btn">Get Currency Rates</button></p>
        <div id="currency-converter-result"></div>

        <div id="animation"></div>
        <?php

    }
    public function get_currency_rates()
    {
        $api_url = 'https://api.exchangerate-api.com/v4/latest/BDT';
        $response = wp_remote_get($api_url);
        if (!is_wp_error($response)) {
            $response_data = wp_remote_retrieve_body($response);
            $data = json_decode($response_data, true);
            $result = [
                'USD' => number_format(1 / $data['rates']['USD'], 2),
                'EUR' => number_format(1 / $data['rates']['EUR'], 2),
                'GBP' => number_format(1 / $data['rates']['GBP'], 2),
                'BGN' => number_format(1 / $data['rates']['BGN'], 2),
                'CHF' => number_format(1 / $data['rates']['CHF'], 2),
            ];
            wp_send_json_success($result);
        } else {
            wp_send_json_error('Fetch Failed');
        }
    }
}