<?php

namespace App\Services;

class StatusChangeService
{
    public function statusChange($item)
    {
        if (!$item) {
            return $this->statusNotFound();
        }

        // Toggle the status (assuming 1 is active and 0 is inactive)
        $item->status = $item->status == 1 ? 0 : 1;
        $item->save();

        return $this->statusChangedSuccessfully();
    }

    protected function statusNotFound()
    {
        return redirect()->back()->with('status', [
            'success' => false,
            'msg' => 'Item not found!',
        ]);
    }

    protected function statusChangedSuccessfully()
    {
        return redirect()->back()->with('status', [
            'success' => true,
            'msg' => 'Status changed successfully!',
        ]);
    }
}
