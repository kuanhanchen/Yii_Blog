<?php
namespace common\models\base;

use yii\db\ActiveRecord;

class BaseModel extends ActiveRecord
{
	public function getPages($query, $curPage = 1, $pageSize = 10, $search = null)
	{
		if($search) {
			$query = $query->andFilterWhere($search);
		}

		// get numbers of rows
		$data['count'] = $query->count();
		
		// if none of row, directly return set value
		if(!$data['count']) {
			return ['count'=>0, 'curPage'=>$curPage, 'pageSize'=>$pageSize, 'start'=>0, 'end'=>0, 'data'=>[]];
		}

		// prevent from exceeding actual page
		// ceil(2.1123) = 3
		// e.g. $data['count'] = 5, $pageSize = 6, ceil(5/6)=1, $curPage = 2 -> $curPage = ceil(5/6)
		// e.g. $data['count'] = 20, $pageSize = 6, ceil(20/6)=4, $curPage = 2 -> $curPage = $curPage
		$curPage = (ceil($data['count'] / $pageSize) < $curPage) ? ceil($data['count'] / $pageSize) : $curPage;

		$data['curPage'] = $curPage;
		$data['pageSize'] = $pageSize;
		$data['start'] = ($curPage - 1) * $pageSize + 1;

		// ceil($data['count'] / $pageSize) = $curPage, means we're in the last page, so the end item, $data['end'], should be $data['count']
		// otherwise, the end item is the last one in that page: $data['end'] = $curPage * $pageSize
		$data['end'] = (ceil($data['count'] / $pageSize) == $curPage) ? $data['count'] : ($curPage * $pageSize);
		$data['data'] = $query->offset(($curPage -  1) * $pageSize)->limit($pageSize)->asArray()->all();

		return $data;
	}
}