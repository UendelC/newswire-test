import { usePage, router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { computed } from 'vue';

const page = usePage();

export function useTask() {
    function formatStatus(task) {
        const rules = {
            'completed': 'Completed',
            'in-progress': 'In Progress',
            'pending': 'Pending',
        }

        return rules[task.status]
    }

    function trimmedDescription(task) {
        return task.description.substring(0, 50) + '...'
    }

    function takeOn(task) {
        const payload = {
            status: task.status !== 'completed' ? 'in-progress' : 'completed',
            user_id: page.props.auth.user.id,
        }

        router.put(route('tasks.update', { task: task.id }), payload, {
            preserveScroll: true,
        })
    }

    function deleteTask(task) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this task!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, keep it',
        }).then((result) => {
            if (result.isConfirmed) {
                router.delete(route('tasks.destroy', { task: task.id }))
            }
        })
    }

    function markAsCompleted(task) {
        const payload = {
            status: 'completed',
        }

        router.put(route('tasks.update', { task: task.id }), payload)
    }

    function isTaskCompleted(task) {
        return task.status === 'completed'
    }

    function showTaskDetails(task) {
        return route('tasks.show', { task: task.id })
    }

    function statusColor(task) {
        const rules = {
            'completed': 'green',
            'in-progress': 'blue',
            'pending': 'yellow',
        }

        return rules[task.status]
    }

  return {
    formatStatus,
    trimmedDescription,
    takeOn,
    deleteTask,
    markAsCompleted,
    isTaskCompleted,
    showTaskDetails,
    statusColor,
  };
}
