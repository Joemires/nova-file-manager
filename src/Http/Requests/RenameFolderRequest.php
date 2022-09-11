<?php

declare(strict_types=1);

namespace BBSLab\NovaFileManager\Http\Requests;

use BBSLab\NovaFileManager\Rules\DiskExistsRule;
use BBSLab\NovaFileManager\Rules\ExistsInFilesystem;
use BBSLab\NovaFileManager\Rules\MissingInFilesystem;

/**
 * @property-read string $from
 * @property-read string $to
 */
class RenameFolderRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return $this->canRenameFolder();
    }

    public function rules(): array
    {
        return [
            'disk' => ['sometimes', 'string', new DiskExistsRule()],
            'from' => ['required', 'string', new ExistsInFilesystem($this)],
            'to' => ['required', 'string', new MissingInFilesystem($this)],
        ];
    }
}
