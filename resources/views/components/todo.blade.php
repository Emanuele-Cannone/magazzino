<div x-data="{
      inputAddTodoValue: '',
      inputEditTodoValue: '',
      todos: [],
      addTodo(){
        if(this.inputAddTodoValue.length){
          this.todos = [
            ...this.todos,
            {
              id: this.todos.length,
              text: this.inputAddTodoValue
            }
          ]
          this.inputAddTodoValue = ''
        }
      },
      showEditTodoForm(id){
        this.todos = this.todos.map(item => {

            if(item.id === id){
              this.inputEditTodoValue = item.text
            }

            return {
              ...item,
              isEditing: item.id === id
            }
          }
        )
      },
      editTodo(id){
        this.todos = this.todos.map(item => ({
            ...item,
            text: item.id === id ? this.inputEditTodoValue : item.text,
            isEditing: false
          })
        )
      },
      cancelEditTodo(){
        this.todos = this.todos.map(item => ({
            ...item,
            isEditing: false
          })
        )
      },
      removeTodo(id){
        this.todos = this.todos.filter(item => item.id !== id)
      }
    }">

    <form @submit.prevent="addTodo()">
        <x-input
            placeholder="Attività"
            type="text"
            name="todo"
            x-model="inputAddTodoValue"
            class="text-black text-center my-1 w-96"
            @keyup.enter="addTodo()"
        />

        <div class="relative overflow-x-auto h-52">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 sticky top-0">
                    <tr></tr>
                </thead>
                <tbody>
                <template x-for="todo in todos">
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            x-text="todo.text"
                        >
                        </th>
                        <td class="px-4 py-4 w-3.5">
                            <button type="button" @click="removeTodo(todo.id)" class="text-xl">x</button>
                        </td>
                    </tr>
                </template>

                </tbody>
            </table>
        </div>

    </form>
</div>
