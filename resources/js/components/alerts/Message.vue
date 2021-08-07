<template>
    <div class="p-2 w-full">
        <div>
            <div
                class="flex justify-center items-center m-1 font-medium py-1 px-2 rounded-md text-yellow-700 bg-yellow-100 border border-yellow-300 "
            >
                <div slot="avatar">
                    
                </div>
                <div class="text-xl font-normal  max-w-full flex-initial">
                    <div class="py-2">
                        {{title}}
                        <div class="text-sm font-base">
                            {{message}}
                            
                        </div>
                    </div>
                </div>
                <div class="flex flex-auto flex-row-reverse">
                    <div>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="100%"
                            height="100%"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="feather feather-x cursor-pointer hover:text-yellow-400 rounded-full w-5 h-5 ml-2"
                        >
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    props: {
        message:{
            type:String,
        },
        title:{
            title:String
        }
    }

}
</script>
