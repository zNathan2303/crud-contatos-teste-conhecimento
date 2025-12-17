import { useState } from "react";

interface InputProps {
  id: string;
  label: string;
  placeholder: string;
}

export default function InputText({ id, label, placeholder }: InputProps) {
  const [focused, setFocused] = useState(false);

  return (
    <div className="flex flex-col">
      <label
        htmlFor={id}
        className={`cursor-pointer text-lg transition-colors w-fit font-medium ${
          focused ? "text-primary" : "text-zinc-500"
        }`}
      >
        {label}
      </label>
      <input
        id={id}
        type="text"
        placeholder={placeholder}
        className={`outline-none border-b-2 text-xl/12 text-zinc-800 transition-colors ${
          focused ? "border-primary" : "border-zinc-400"
        }`}
        onFocus={() => setFocused(true)}
        onBlur={() => setFocused(false)}
      />
    </div>
  );
}
