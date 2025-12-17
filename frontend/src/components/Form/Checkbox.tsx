interface CheckboxProps {
  id: string;
  label: string;
}

export default function Checkbox({ id, label }: CheckboxProps) {
  return (
    <div className="flex items-center gap-4">
      <input
        type="checkbox"
        id={id}
        className="size-5 cursor-pointer appearance-none rounded-md border-2 border-zinc-400 bg-transparent
        transition-all checked:bg-primary checked:border-primary checked:bg-checked"
      />
      <label htmlFor={id} className="text-zinc-500 cursor-pointer">
        {label}
      </label>
    </div>
  );
}
