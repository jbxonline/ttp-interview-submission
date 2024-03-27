<?php 

class WidgetController extends BaseController
{
    public function index()
    {
        $widgets = Widget::all();
        if (Request::wantsJson()) {
            return Response::json($widgets);
        }

        return View::make('widgets.index')->with('widgets', $widgets);
    }

    public function create()
    {
        return View::make('widgets.create');
    }

    public function store()
    {
        $validator = Validator::make(
            Input::all(),
            [
                'name' => 'required|unique:widgets',
                'color' => 'required'
            ]
        );

        if ($validator->fails()) {
            return Redirect::route('widgets.new')
                ->withErrors($validator)
                ->withInput();
        }
        $widget = Widget::create([
            'name' => Input::get('name'),
            'color' => Input::get('color'),
            'description' => Input::get('description', null)
        ]);

        return Redirect::route('widgets.index');
    }

    public function edit(Widget $widget)
    {
        return View::make('widgets.edit')->with('widget', $widget);
    }

    public function update(Widget $widget)
    {
        $validator = Validator::make(
            Input::all(),
            [
                'name' => 'required|unique:widgets,name,' . $widget->id,
                'color' => 'required'
            ]
        );

        if ($validator->fails()) {
            return Redirect::route('widgets.edit', $widget->id)
                ->withErrors($validator)
                ->withInput();
        }

        $widget->name = Input::get('name');
        $widget->color = Input::get('color');
        $widget->description = Input::get('description', null);
        $widget->save();
        return Redirect::route('widgets.index');
    }

    public function destroy(Widget $widget)
    {
        $widget->delete();
        return Response::json([], 204);
    }
}
