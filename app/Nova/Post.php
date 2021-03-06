<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
//use Ctessier\NovaAdvancedImageField\AdvancedImage;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class Post extends Resource
{
    public static $displayInNavigation = false;
    public static $group = "จัดการข้อมูลธุรกิจ";
    public static $priority = 5;
    /**
     * The model the resource corresponds to.
     *
     * @var  string
     */
    public static $model = \App\Post::class;
    public static $with = ['user'];

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var  string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var  array
     */
    public static $search = [
        'id', 'title', 'content'
    ];

    /**
     * Get the displayable label of the resource.
     *
     * @return  string
     */
    public static function label()
    {
        return __('Post');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return  string
     */
    public static function singularLabel()
    {
        return __('Post');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('Id'),  'id')
                ->rules('required')
                ->sortable(),
            Boolean::make(__('Published'), 'published')
                ->showOnCreating(function ($request) {
                    return $request->user()->role == 'admin';
                })
                ->showOnUpdating(function ($request) {
                    return $request->user()->role == 'admin';
                })
                ->sortable(),
            Text::make(__('Title'), 'title')
                ->rules('required')
                ->sortable(),
            BelongsTo::make(__('Vendor Name'), 'vendor', 'App\Nova\Vendor')
                ->rules('required')
                ->showCreateRelationButton(),

            Textarea::make(__('Post Content'),  'content')
                ->rules('required')
                ->hideFromIndex()
                ->sortable(),
            // Image::make(__('Image'),  'post_image')
            //     ->hideFromIndex()
            //     ->maxWidth(600),
            Image::make(__('Image'), 'post_image')
                ->hideFromIndex()
                ->rules("mimes:jpeg,bmp,png", "max:2000")
                ->help('ขนาดไฟล์ไม่เกิน 2 MB.'),
            DateTime::make(__('Published_at'),  'published_at')
                ->hideFromIndex()
                ->sortable(),
            BelongsTo::make(__('User'), 'user', 'App\Nova\User')
                ->canSee(function ($request) {
                    return $request->user()->role == 'admin';
                }),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  array
     */
    public function actions(Request $request)
    {
        return [
            (new Actions\SetPostPublished)
                ->confirmText('ต้องการเผยแพร่โพที่เลือก?')
                ->confirmButtonText('เผยแพร่')
                ->cancelButtonText("ยกเลิก")
                ->canSee(function ($request) {
                    return $request->user()->role == 'admin';
                }),
            (new Actions\SetPostNotPublished)
                ->confirmText('ไม่ต้องการเผยแพร่โพสที่เลือก?')
                ->confirmButtonText('ไม่เผยแพร่')
                ->cancelButtonText("ยกเลิก")
                ->canSee(function ($request) {
                    return $request->user()->role == 'admin';
                }),
        ];
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        if ($request->user()->role == 'member') {
            return $query->where('user_id', $request->user()->id);
        }
        return $query;
    }
}
