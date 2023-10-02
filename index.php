<?php

$data = [1, 2, 3, 4, 5, 6, 7, 9, 10, 11, 12, 13, 14, 15];
$positive = new Positive($data);

echo 'Количество четных элементов: ' . $positive->OddCount() . '<br>';
echo 'Массив элементов удовлетворяющих битовой маске 10: ' . implode(', ', $positive->MaskList(10)) . '<br>';
echo 'Среднее арифметическое элементов: ' . $positive->Average() . '<br>';

class Positive
{
    private array $data;

    public function __construct(array $array)
    {
        $this->data = array_filter($array, function ($value) {
            return is_int($value) && $value > 0;
        });
    }

    public function OddCount(): int
    {
        return count(array_filter($this->data, function ($value) {
            return $value % 2 === 0;
        }));
    }

    public function MaskList(int $mask): array
    {
        return array_values(array_filter($this->data, function ($value) use ($mask) {
            return ($value & $mask) === $mask;
        }
        ));
    }

    public function Average(): float
    {
        $sum = 0;
        $count = 0;

        foreach ($this->data as $value) {
            if ($value % 3 === 0) {
                $sum += 3;
                ++$count;
            } elseif ($value % 5 === 0) {
                $sum += -5;
                ++$count;
            }
        }

        if ($count === 0) {
            return 0;
        }

        return $sum / $count;
    }
}
