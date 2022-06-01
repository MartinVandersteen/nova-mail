<?php

namespace KirschbaumDevelopment\NovaMail\Nova;

use Laravel\Nova\Resource;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use KirschbaumDevelopment\NovaMail\Events;
use Laravel\Nova\Http\Requests\NovaRequest;
use KirschbaumDevelopment\NovaMail\Models\NovaMailTemplate as NovaMailTemplateModel;

class NovaMailTemplate extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = NovaMailTemplateModel::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Name'),

            Text::make('Subject'),

            Code::make('Content')
                ->language('markdown')
                ->hideFromIndex(),

            Number::make('Send delay (minutes)', 'send_delay_in_minutes'),

            Events::make('Events')
                ->hideWhenCreating()
                ->help('Targeting a specific column is only available on the "Updated" event.'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return Str::plural('Mail Template');
    }

    /**
     * Determine if this resource is available for navigation.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return bool
     */
    public static function availableForNavigation(NovaRequest $request)
    {
        return config('nova_mail.show_resources.nova_mail_template');
    }
}
