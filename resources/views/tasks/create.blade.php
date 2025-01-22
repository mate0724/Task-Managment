<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Új feladat létrehozása
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('groups.tasks.store', $group) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-4">
                            <label for="title">Cím</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="description">Leírás</label>
                            <textarea name="description" id="description" class="form-control" required></textarea>
                        </div>

                        <div class="form-group mb-4">
                            <label for="status">Státusz</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="todo">Teendő</option>
                                <option value="in_progress">Folyamatban</option>
                                <option value="completed">Befejezett</option>
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label for="priority">Prioritás</label>
                            <select name="priority" id="priority" class="form-control" required>
                                <option value="low">Alacsony</option>
                                <option value="medium">Közepes</option>
                                <option value="high">Magas</option>
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label for="due_date">Határidő</label>
                            <input type="date" name="due_date" id="due_date" class="form-control">
                        </div>

                        <div class="form-group mb-4">
                            <label for="file">Csatolmány (opcionális)</label>
                            <input type="file" name="file" id="file" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-success">Mentés</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
