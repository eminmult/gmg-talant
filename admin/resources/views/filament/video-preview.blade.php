<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    @if($getRecord()?->video_path)
        <video
            controls
            preload="metadata"
            style="width: 100%; max-width: 640px; border-radius: 8px; background: #000;"
        >
            <source src="{{ Storage::disk('public')->url($getRecord()->video_path) }}" type="video/mp4">
            Brauzeriniz video teqini dəstəkləmir.
        </video>
    @else
        <p style="color: #6b7280; font-size: 14px;">Video yüklənməyib</p>
    @endif
</x-dynamic-component>
