<?php

namespace App\Services;

use App\Category;

class DataSetService
{

    public function getNestedDataSets()
    {
        // Get all data sets and order them alphabetically by name
        $dataSets = Category::where('business_id', 5)->orderBy('name')->get();

        // Group data sets by their parent IDs
        $groupedDataSets = $dataSets->groupBy('parent_id');

        // Build the hierarchical structure recursively
        $result = $this->buildHierarchy($groupedDataSets, 0);

        return $result;
    }


    protected function buildHierarchy($groupedDataSets, $parentId)
    {
        $result = [];

        // Check if the parent ID exists in the grouped data sets
        if (isset($groupedDataSets[$parentId])) {
            // Iterate over the child data sets
            foreach ($groupedDataSets[$parentId] as $dataSet) {
                // Recursively build hierarchy for child data sets
                $children = $this->buildHierarchy($groupedDataSets, $dataSet->id);
                // Add the current data set with its children to the result
                $result[] = [
                    'id' => $dataSet->id,
                    'name' => $dataSet->name,
                    'children' => $children,
                ];
            }
        }

        return $result;
    }
}
