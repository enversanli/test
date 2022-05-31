<?php
namespace Semrush\HomeTest\Http;


use Semrush\HomeTest\Http\Actions\GenerateUrlAction;

class IdGenerator
{
    public function __construct()
    {

    }


    public function newGenerate(string $url): string
    {
        exit("Sivas");
    }

    public function generate()
    {
        $generateAction = new GenerateUrlAction();

        $generateAction->index();
        return ["Sivas"];
    }
}
