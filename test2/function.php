<?php

function tree($array)
{
    $tree = [];
    $count = 0;
    foreach ($array as $key=>$value)
    {
        if ($value['parent_id'] !== 0)
        {
            $test = $value['parent_id'];
            if (array_key_exists("$test", $tree)) {
                if(is_array($tree[$value['parent_id']])) {
                    $count++;
                    $tree[$value['parent_id']] = $tree[$value['parent_id']] + [$value['categories_id'] =>$value['categories_id']];
                }
                elseif (!is_array($tree[$value['parent_id']])) {
                    $count++;
                    $tree[$value['parent_id']] = [$value['categories_id']=>$value['categories_id']];
                }
//                findElement($value, $tree);
            }
            else {
                foreach ($tree as &$ttt) {
                    if (is_array($ttt)) {
                        if (array_key_exists("$test", $ttt)) {
                            if(is_array($ttt[$value['parent_id']])) {
                                $count++;
                                $ttt[$value['parent_id']] = $ttt[$value['parent_id']] + [$value['categories_id'] =>$value['categories_id']];
                            }
                            elseif (!is_array($ttt[$value['parent_id']])) {
                                $count++;
                                $ttt[$value['parent_id']] = [$value['categories_id']=>$value['categories_id']];
                            }
//                findElement($value, $tree);
                        }
                    }
                }
            }

        }
        else  {
            $tree[$key] = $value['categories_id'];
            $count++;
        }

    }
    $multidimensionalArray = $tree;



    $totalElements = count_recursive($multidimensionalArray);

    echo "Количество элементов в многомерном массиве: $count";
    return $tree;
}

function count_recursive($array) {
    $count = 0;

    foreach ($array as $value) {
        if (is_array($value)) {
            // Рекурсивный вызов для подсчета элементов во вложенных массивах
            $count += count_recursive($value);
        } else {
            // Увеличиваем счетчик для каждого элемента в массиве
            $count++;
        }
    }

    return $count;
}