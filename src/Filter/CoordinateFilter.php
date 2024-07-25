<?php

namespace App\Filter;

use ApiPlatform\Doctrine\Orm\Filter\AbstractFilter;
use Doctrine\ORM\QueryBuilder;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Metadata\Operation;
use Symfony\Component\PropertyInfo\Type;

final class CoordinateFilter extends AbstractFilter
{
    protected function filterProperty(string $property, $value, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, ?Operation $operation = null, array $context = []): void
    {
        $parameterName = $queryNameGenerator->generateParameterName($property);
        // dd(count($value));
        if ($parameterName !== 'coordinate_p1' || !is_array($value) || count($value) < 2) {
            return;
        }
        $userLatitude = floatval($value[0]);
        $userLongitude = floatval($value[1]);
        if (count($value) == 2) {
            $limitDistance = 30;
        } else {
            $limitDistance = intval($value[2]);
        }

        $qb = $queryBuilder
            ->addSelect("( 6371 * acos( cos( radians(:latitude) ) * cos( radians( o.latitude ) ) * cos( radians( o.longitude ) - radians(:longitude) ) + sin( radians(:latitude) ) * sin( radians( o.latitude ) ) ) ) AS distance")
            ->having("distance <= :limitDistance")
            ->setParameter('latitude', $userLatitude)
            ->setParameter('longitude', $userLongitude)
            ->setParameter('limitDistance', $limitDistance)
            ;
    }

    public function getDescription(string $resourceClass): array
    {
        $description["coordinate"] = [
            'property' => 'coordinate',
            'type' => Type::BUILTIN_TYPE_ARRAY,
            'required' => false,
            'description' => 'Filter using user coordinate and kilometric section',
            'openapi' => [
                'example' => '?coordinate[]=44.8256&coordinate[]=1.14673&coordinate[]=30',
                'allowReserved' => false,
                'allowEmptyValue' => false,
                'explode' => true,
            ],
        ];
        return $description;
    }
}