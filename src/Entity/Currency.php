<?php

namespace Entity;

class Currency
{

    const TABLE_NAME = 'Currencies';

    private int $id;

    private string $name;

    private string $code;

    private int $buyValue;

    private int $sellValue;

    private int $date;


    public function __construct( string $name, string $code, int $buyValue, int $sellValue)
    {
        $this->name = $name;
        $this->code = $code;
        $this->buyValue = $buyValue;
        $this->sellValue = $sellValue;
        $this->date = (new \DateTime("midnight"))->getTimestamp();
    }


    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'code' => $this->code,
            'buy_value' => $this->buyValue,
            'sell_value' => $this->sellValue,
            'date' => $this->date,

        ];
    }

}