<?php
namespace Laventure\Component\Database\ORM\Persistence\Mapping;


/**
 * @ClassMetadataInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\Persistence\Mapping
*/
interface ClassMetadataInterface
{

     /**
      * Returns class name
      *
      * @return string
     */
     public function getName(): string;




     /**
      * Returns class identifier
      *
      * @return string
     */
     public function getIdentifier(): string;





     /**
      * Returns reflection class
      *
      * @return mixed
     */
     public function getReflection(): mixed;





     /**
      * Determine if the given field name is class identifier
      *
      * @param string $field
      *
      * @return bool
     */
     public function isIdentifier(string $field): bool;






     /**
      * Determine if the given field name in class metadata
      *
      * @param string $field
      *
      * @return bool
     */
     public function hasField(string $field): bool;






     /**
      * Determine if the given field has association fields
      *
      * @param string $field
      *
      * @return bool
     */
     public function hasAssociation(string $field): bool;





     /**
      * @param string $field
      *
      * @return bool
     */
     public function isSingleValueAssociation(string $field): bool;






     /**
      * @param string $field
      *
      * @return bool
     */
     public function isCollectionValueAssociation(string $field): bool;







     /**
      * Returns class field name
      *
      * @return array
     */
     public function getFieldNames(): array;






     /**
      * @return array
     */
     public function getIdentifierFieldNames(): array;






     /**
      * Returns all field association
      *
      * @return array
     */
     public function getAssociationNames(): array;






     /**
      * @param $field
      *
      * @return mixed
     */
     public function getTypeOfField($field): mixed;





     /**
      * @param string $associationName
      *
      * @return mixed
     */
     public function getAssociationTargetClass(string $associationName): mixed;







     /**
      * @param string $associationName
      *
      * @return mixed
     */
     public function isAssociationInverseSide(string $associationName): mixed;







     /**
      * @param string $associationName
      *
      * @return mixed
     */
     public function getAssociationMappedByTargetField(string $associationName): mixed;






     /**
      * @param $object
      *
      * @return mixed
     */
     public function getIdentifierValues($object): mixed;
}