<?php

namespace App\Traits;

trait ActiveInactiveStatus
{
    public function changeStatus($item, $routeName, $modelName)
    {
        if (!$item) {
            return $this->NotFound($modelName);
        }

        // Toggle the status (assuming 1 is active and 0 is inactive)
        $item->status = $item->status == 1 ? 0 : 1;
        $item->save();

        return $this->SuccessFull($modelName, $routeName);
    }

    public function NotFound($modelName)
    {
        return redirect()->back()->with('status', [
            'success' => false,
            'msg' => $modelName . ' Not Found!',
        ]);
    }

    public function SuccessFull($modelName, $routeName)
    {
        return redirect()->route($routeName)->with('status', [
            'success' => true,
            'msg' => $modelName . ' Status Changed Successfully!',
        ]);
    }
}
