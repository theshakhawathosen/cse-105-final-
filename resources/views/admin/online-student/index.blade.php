@extends('layouts.admin.admin-layout')
@section('title', 'Online Students')

@section('content')

    <main id="main-content">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">

            <div>
                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i>
                    Online Students
                </span>

                <h1 class="text-xl font-bold text-tp mt-4">
                    Online Students List
                </h1>

                <p class="text-ts text-sm">
                    Manage all online students
                </p>
            </div>

        </div>

        <!-- Table Card -->
        <div class="dash-card p-5 fade-up fade-up-d2">

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead>

                        <tr class="border-b border-border text-ts">

                            <th class="py-3 text-left">
                                Photo
                            </th>

                            <th class="py-3 text-left">
                                Name
                            </th>

                            <th class="py-3 text-left">
                                Roll
                            </th>

                            <th class="py-3 text-left">
                                Email
                            </th>

                            <th class="py-3 text-left">
                                Role
                            </th>
                            <th class="py-3 text-left">
                                Status
                            </th>


                        </tr>

                    </thead>

                   <tbody id="onlineUsersTable" class="text-tp"></tbody>

                </table>

            </div>

        </div>

    </main>

@endsection
@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        let onlineUsers = [];

        window.Echo.join('online-students')

            .here((users) => {

                onlineUsers = users;
                renderUsers();

            })

            .joining((user) => {

                if (!onlineUsers.find(u => u.id === user.id)) {

                    onlineUsers.push(user);

                }

                renderUsers();

            })

            .leaving((user) => {

                onlineUsers = onlineUsers.filter(
                    u => u.id !== user.id
                );

                renderUsers();

            });

        function renderUsers() {

            let html = '';

            if (onlineUsers.length === 0) {

                html = `
                    <tr>
                        <td colspan="5" class="py-6 text-center text-ts">
                            No students online
                        </td>
                    </tr>
                `;

            } else {

                onlineUsers.forEach(user => {

                    html += `
                        <tr class="border-b border-border hover:bg-input/40 transition">

                            <td class="py-3">
                                <img
                                    src="${user.photo ?? '/default.png'}"
                                    alt="${user.name}"
                                    class="w-10 h-10 rounded-full object-cover">
                            </td>

                            <td class="py-3">
                                ${user.name}
                            </td>

                            <td class="py-3">
                                ${user.roll ?? '-'}
                            </td>

                            <td class="py-3">
                                ${user.email ?? '-'}
                            </td>

                            <td class="py-3">
                                ${user.role ?? '-'}
                            </td>

                            <td class="py-3">
                                <span class="px-2 py-1 rounded-lg bg-green-500/10 text-green-400 border border-green-500/20">
                                    Online
                                </span>
                            </td>

                        </tr>
                    `;
                });

            }

            document.getElementById('onlineUsersTable').innerHTML = html;

            console.log('Online Users:', onlineUsers);

        }

    });
</script>
@endpush
