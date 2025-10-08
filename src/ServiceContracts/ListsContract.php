<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\RecipientPreferences;
use Courier\RequestOptions;
use Courier\List;
use Courier\Core\Exceptions\APIException;
use Courier\Lists\ListListResponse;

use const Courier\Core\OMIT as omit;

interface ListsContract{


      /**
  * @api
  * 
  * @param string $listID
  * @param RequestOptions|null $requestOptions
  * 
  * @return List
  * 
  * @throws APIException
 */public function retrieve(
        string $listID, ?RequestOptions $requestOptions = null
      ): List;



      /**
  * @api
  * 
  * @param string $listID
  * @param string $name
  * @param RecipientPreferences|null $preferences
  * @param RequestOptions|null $requestOptions
  * 
  * @return mixed
  * 
  * @throws APIException
 */public function update(
        string $listID,
        $name,
        $preferences = omit,
        ?RequestOptions $requestOptions = null,
      ): mixed;



      /**
  * @api
  * 
  * @param string $listID
  * @param array<string, mixed> $params
  * @param RequestOptions|null $requestOptions
  * 
  * @return mixed
  * 
  * @throws APIException
 */public function updateRaw(
        string $listID, array $params, ?RequestOptions $requestOptions = null
      ): mixed;



      /**
  * @api
  * 
  * @param string|null $cursor A unique identifier that allows for fetching the next page of lists.
  * @param string|null $pattern "A pattern used to filter the list items returned. Pattern types supported: exact match on `list_id` or a pattern of one or more pattern parts. you may replace a part with either: `*` to match all parts in that position, or `**` to signify a wildcard `endsWith` pattern match."
  * @param RequestOptions|null $requestOptions
  * 
  * @return ListListResponse
  * 
  * @throws APIException
 */public function list(
        $cursor = omit, $pattern = omit, ?RequestOptions $requestOptions = null
      ): ListListResponse;



      /**
  * @api
  * 
  * @param array<string, mixed> $params
  * @param RequestOptions|null $requestOptions
  * 
  * @return ListListResponse
  * 
  * @throws APIException
 */public function listRaw(
        array $params, ?RequestOptions $requestOptions = null
      ): ListListResponse;



      /**
  * @api
  * 
  * @param string $listID
  * @param RequestOptions|null $requestOptions
  * 
  * @return mixed
  * 
  * @throws APIException
 */public function delete(
        string $listID, ?RequestOptions $requestOptions = null
      ): mixed;



      /**
  * @api
  * 
  * @param string $listID
  * @param RequestOptions|null $requestOptions
  * 
  * @return mixed
  * 
  * @throws APIException
 */public function restore(
        string $listID, ?RequestOptions $requestOptions = null
      ): mixed;


}